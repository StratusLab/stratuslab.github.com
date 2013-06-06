---
layout: article
title: Growing a partition and resizing file system inside a raw image
category: review
---


Making a partition grows and resizing file system inside a raw image, is possible using the following set of tools:

* kpartx tool for mounting partitions within an image file. kpartx is part of the Linux multipath-tools.
* e2fsck command to check ext2, ext3, or ext4 filesystems.
* resize2fs program to resize ext2, ext3, or ext4 file systems.

Suppose we want to resize Ubuntu-13.04-x86_64-base-1.0.img image. In this image, root disk has actually 5GB of space, and we want to resize it to 10 GB.

First thing to do, create an image file with 10GB of space.

    $ dd if=/dev/zero of=my_new_ubuntu_image_10GB.img bs=2048 count=10000000 

Copy Ubuntu-13.04-x86_64-base-1.0.img into my_new_ubuntu_image_10GB.img file. 

    $ dd if=Ubuntu-13.04-x86_64-base-1.0.img of=my_new_ubuntu_image_10GB.img conv=notrunc bs=2048

 notrunc conversion value is passed to dd command, so the output file (my_new_ubuntu_image_10GB.img) is not truncated.

kpartx discovers automatically the partitions within an image file, and make them available via /dev/mapper/loop0pX, where X is the number of the partition.

    $ kpartx -av my_new_ubuntu_image_10GB.img 
      add map loop0p1 (253:5): 0 10481664 linear /dev/loop0 2048

In our case, because all the StratusLab images endorsed by images@stratuslab.eu are created with only one partition, this partition will be available via /dev/mapper/loop0p1.

Check the file system

    $ e2fsck -f /dev/mapper/loop0p1

e2fsck can check a Linux ext2/ext3/ext4 file system

Enlarge the file system located on /dev/mapper/loop0p1

    $ resize2fs -f -y /dev/mapper/loop0p1

Disconnect the mapper devices with kpartx -d command

    $ kpartx -dv my_new_ubuntu_image_10GB.img 
      del devmap : loop0p1 
      loop deleted : /dev/loop0 

The new ubuntu image my_new_ubuntu_image_10GB.img with 10GB space in root disk is available to use.

Done!

