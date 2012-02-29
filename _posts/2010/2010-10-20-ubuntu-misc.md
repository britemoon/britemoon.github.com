---
layout: post
category : Ubuntu
tags : [Ubuntu,Linux]
title: Ubuntu使用小技巧
---
{% include JB/setup %}

1.Ext3升级到Ext4

    Which '/dev/XXXX' is your filesystem ID
    1.sudo tune2fs -O extents,uninit_bg,dir_index /dev/XXXX
    2.sudo fsck -pf /dev/XXXX
    3.sudo mount -t ext4 /dev/XXXX /mnt
    4.Open fstab and change the ext3 entry to ext4.Save and exit.

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

5.修复grub2

    如果手上有grub启动的工具盘,用工具盘启动,在grub菜单上按c进入命令行状态
    在grub>提示符下输入
    grub>find /boot/grub/core.img (有/boot分区的用find /grub/core.img)
    (hdx,y) (显示查找到的分区号）
    grub>root (hdx,y)
    grub>kernel /boot/grub/core.img (/boot分区的用 kernel /grub/core.img)
    grub>boot
    执行boot后能转入grub2菜单，启动ubuntu后,再在ubuntu终端下执行
    sudo grub-install /dev/sda (或sdb，sdc等）修复grub

6.Audacious中歌曲名乱码问题的解决

    Audacious中的歌曲产生乱码主要是IDV3标签都是GB编码的,只要不显示IDV3信息就可以了.
    1.在audacious上右键选择"首选项"
    2.在"播放列表"中,把标题格式改为"Custom"
    3.再把自定格式改为"%f"(不要引号).
    如果没有显示的话不要急,刷新一遍歌曲列表就可以了.

7.ssh tunnel

    #在本地的 213 端口新建一个链接到远程服务器的ssh tunnel实现SOCKS代理，通过远程服务器实现不可能的访问
    ssh -D 213 username@remotesshserver.com