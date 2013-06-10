---
layout: article
title: Growing a partition and resizing file system inside a raw image
category: review
---


Making a partition grows and resizing file system inside a raw image, is possible using the following set of tools:

* parted a partition manipulation program.
* kpartx tool for mounting partitions within an image file. kpartx is part of the Linux multipath-tools.
* e2fsck command to check ext2, ext3, or ext4 filesystems.
* resize2fs an ext2/ext3/ext4 file system resizer

Suppose we want to resize Ubuntu-13.04-x86_64-base-1.0.img image. In this image, root disk has actually 5GB of space, and we want to resize it to 10 GB.

First thing to do, create an image file with 10GB of space.

    $ dd if=/dev/zero of=my_new_ubuntu_image_10GB.img bs=1024 count=10000000 

Copy Ubuntu-13.04-x86_64-base-1.0.img into my_new_ubuntu_image_10GB.img file. 

    $ dd if=Ubuntu-13.04-x86_64-base-1.0.img of=my_new_ubuntu_image_10GB.img conv=notrunc bs=1024

 notrunc conversion value is passed to dd command, so the output file (my_new_ubuntu_image_10GB.img) is not truncated.

All the StratusLab images endorsed by images@stratuslab.eu are created with only one partition. 

Delete the current partition in my_new_ubuntu_image_10GB.img

    $ parted my_new_ubuntu_image_10GB.img rm 1

Create a new partition as primary, set the first cylinder, and reservce the whol space for this partition

    $ parted my_new_ubuntu_image_10GB.img mkpart primary 1049kB -- -1s 

Make it bootable

    $ parted my_new_ubuntu_image_10GB.img toogle 1 boot 


kpartx discovers automatically the partitions within an image file, and make them available via /dev/mapper/loop0pX, where X is the number of the partition.

    $ kpartx -av my_new_ubuntu_image_10GB.img 
      add map loop0p1 (253:5): 0 10481664 linear /dev/loop0 2048

In our case, there will be only one partition in my_new_ubuntu_image_10GB.img, this partition will be available via /dev/mapper/loop0p1.

Check the file system

    $ e2fsck -f -y /dev/mapper/loop0p1

e2fsck can check a Linux ext2/ext3/ext4 file system

Resize the file system

    $ resize2fs /dev/mapper/loop0p1


Disconnect the mapper devices with kpartx -d command

    $ kpartx -dv my_new_ubuntu_image_10GB.img 
      del devmap : loop0p1 
      loop deleted : /dev/loop0 


The new ubuntu image my_new_ubuntu_image_10GB.img with 10GB space in root disk is available to use.


NB: 

* This procedure was tested with: openSUSE-12.3-x86_64-base-1.0.img, Ubuntu-13.04-x86_64-base-1.0.img, CentOS-6.4-x86_64-base-1.0.img, and SL-6.4-x86_64-base-1.0.img  images.
* Creation of new partition and resizing file system steps, are no more needed in image with kernel 3.8.0. Actually only Ubuntu 13.04 has this property.
