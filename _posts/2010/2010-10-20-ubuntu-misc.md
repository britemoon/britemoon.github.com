---
layout: post
category : Ubuntu
tags : [Ubuntu, Linux]
title: Ubuntu使用小技巧
---
{% include JB/setup %}

1.Ext3升级到Ext4

    Which '/dev/XXXX' is your filesystem ID
    sudo tune2fs -O extents,uninit_bg,dir_index /dev/XXXX
    sudo fsck -pf /dev/XXXX
    sudo mount -t ext4 /dev/XXXX /mnt
    Open fstab and change the ext3 entry to ext4.Save and exit.

2.使用sudo不需要密码

    #编辑sudoers,将最后一行改为
    %admin ALL=NOPASSWD:ALL

3.文件名编码批量转换

    convmv -f 源编码 -t 新编码 [选项] 文件名
    #常用参数:
    -r #递归处理子文件夹
    -notest #真正进行操作,请注意在默认情况下是不对文件进行真实操作的,而只是试验。
    -list #显示所有支持的编码
    -unescap #可以做一下转义,比如把%20变成空格
    #比如我们有一个utf8编码的文件名,转换成GBK编码,命令如下:
    convmv -f UTF-8 -t GBK --notest utf8编码的文件名

4.批量转换文件内容编码

    #1.使用enca,例如要把当前目录下的所有文件都转成utf-8
    $enca -x utf-8 *
    #2.使用iconv 转换Mp3的ID3v标签
    iconv的命令格式如下:
    iconv -f encoding -t encoding inputfile
    #比如将一个UTF-8 编码的文件转换成GBK编码
    iconv -f GBK -t UTF-8 file1 -o file2

5.ssh tunnel

    #在本地的 213 端口新建一个链接到远程服务器的ssh tunnel实现SOCKS代理，通过远程服务器实现不可能的访问
    ssh -D 213 username@remotesshserver.com
