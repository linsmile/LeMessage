<?php
namespace LeMessage\IM;

use LeMessage\IM;

use Aws\S3\S3Client;
use Aws\S3\ObjectUploader;
use Aws\S3\MultipartUploader;
use Aws\S3\Exception\MultipartUploadException;

class Storage extends IM {


    /**
     * 获取aws 上传的授权token
     * @return mixed
     */
    public function aws_token()
    {
        $uri = self::API_DOMAIN . '/?ct=storage&ac=aws_token';

        return $this->get($uri);
    }

    /**
     *  aws 上传完成回调
     * @param $file       文件的key
     * @param $type       文件后缀; 如:jpg,amr 等
     * @param $size       文件大小
     * @param $hash       文件md5
     * @param $realname   文件原名,用于显示
     * @param $width      图片宽度
     * @param $height     图片高度
     * @param int $duration 语音或视频长度
     * @return mixed
     */
    public function aws_callback($file, $type, $size, $hash, $realname, $width, $height, $duration = 0)
    {
        $post_data  =  [
            'file'     => $file,
            'type'     => $type,
            'size'     => $size,
            'hash'     => $hash,
            'realname' => $realname,
            'width'    => $width,
            'height'   => $height,
            'duration' => $duration
        ];

        $uri = self::API_DOMAIN . '/?ct=storage&ac=aws_callback';

        return $this->post($uri, $post_data);
    }

    /**
     *  aws 上传
     *
     * @param $file        文件本地路径
     * @param $uploadtype  上传类型;可选: image/voice/file
     * @param $filetype    文件后缀
     * @param $realname    文件原名
     * @param int $width   图片宽度(不是图片的，传0)
     * @param int $height  图片高度(不是图片的，传0)
     * @param int $duration 语音或视频长度(不是视频或语音的，传0)
     * @return array|bool
     * @throws \Exception
     */
    public function aws_upload($file, $uploadtype, $filetype, $realname, $width = 0, $height = 0, $duration = 0)
    {
        $aws_token = $this->aws_token();

        if($aws_token['code'] != 0)
        {
            throw new \Exception($aws_token['msg'], $aws_token['code']);
        }

        $options = [
            'version'     => $aws_token['data']['version'],
            'region'      => $aws_token['data']['region'],
            'credentials' => $aws_token['data']['credentials'],
            'debug'       => false,
            'retries'     => 3,
        ];

        $s3Client = new S3Client($options);

        $filehash = md5_file($file);
        if($uploadtype  == 'voice')
        {
            $key = "voices/" . $filehash . '.' . $filetype;
        }
        else
        {
            $key = "files/" . $filehash . '.' . $filetype;
        }

        $filesize = filesize($file);

        // Using stream instead of file path
        $source = fopen($file, 'rb');

        $uploader = new ObjectUploader(
            $s3Client,
            $aws_token['data']['bucket'],
            $key,
            $source
        );

        $filename = $aws_token['data']['bucket'] . '/' . $key;

        do {
            try {
                $result = $uploader->upload();
                if ($result["@metadata"]["statusCode"] == '200') {

                    $this->aws_callback($filename, $filetype, $filesize, $filehash, $realname, $width, $height, $duration);
                    //print('<p>File successfully uploaded to ' . $result["ObjectURL"] . '.</p>');
                    return [
                        'name'     => $filename,
                        'type'     => $filetype,
                        'size'     => $filesize,
                        'hash'     => $filehash,
                        'realname' => $realname,
                        'width'    => $width,
                        'height'   => $height,
                        'duration' => $duration
                    ];

                }
                //print($result);
            } catch (MultipartUploadException $e) {
                rewind($source);
                $uploader = new MultipartUploader($s3Client, $source, [
                    'state' => $e->getState(),
                ]);
            }
        } while (!isset($result));

        return false;
    }


}
