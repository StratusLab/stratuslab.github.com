---
layout: article
title: StratusLab Reference Cloud Infrastructures
category: documentation
---

StratusLab has deployed a reference infrastructure and offers access to
external third parties in order to test and evaluate the cloud solutions
developed by the project. This infrastructure builds upon the latest stable
release 1.2 of the StratusLab distribution and provides two types of cloud
services:

* A cloud computing site for instantiating and managing Virtual Machines, as
    well as for creating persistent storage volumes to preserve and share your
    data and applications among multiple VM instances.
* A Marketplace providing access to pre-configured Virtual Machine and Disk
    images

The physical cloud-computing infrastructure is located in Athens, Greece, and
is operated by [GRNET][grnet], the main resource provider of the StratusLab
project. The project Marketplace instance is hosted by [Trinity College Dublin
(TCD), Ireland][tcd], which is responsible for the curation and provision of
VM images and appliances.

How I can request access to the StratusLab infrastructure?
----------------------------------------------------------

In order to gain access to the reference cloud service and be able to
instantiate your own Virtual Machines you should send an email to
support@stratuslab.eu providing your full name, contact details, your
institute and the project in which you are involved (if applicable).

For user authentication two different mecahnisms are supported:

* Username/password pair generated internally from StratusLab operations
* Digital certificate issued by an [IGTF][igtf] accredited Certification
    Authority. In this case authentication can be done directly using this
    certificate or by generating a VOMS proxy certificate signed from the
    above.

During your enrollment you may chose either authentication method. For the
certificate based ones you will have to send us in your request the
Distinguished Name as it appears in your certificate.

Once your request is approved you will be sent an email with the details for
accessing the cloud service.

What I need to access the StratusLab reference cloud?
-----------------------------------------------------

You will need to download the StratusLab client tools that allow you to access
remotely the cloud and to control the lifecycle of your Virtual Machine
instances. They also allow you to create entries for the Marketplace, generate
your own VM appliances based on pre-existing images which then can be
reference from the Marketplace and instantiated in the cloud.

The tools are available from our [Get Started][get-started] page.

The endpoint for invoking the cloud services is `cloud.grnet.stratuslab.eu`.
The above hostname should be passed as a parameter to StratusLab command line
tools or be set in the `STRATUS_ENDPOINT` environment variable.

Which virtualization technologies do you use?
---------------------------------------------

At the heart of the StratusLab distribution lies [OpenNebula v2.2][one] cloud
management toolkit. OpenNebula is an open-source software developed by UCM
(Universidad Complutense de Madrid). The client-side tools communicate with
the OpenNebula endpoint through the native XML-RPC protocol provided by the
service. Additional cloud management APIs (OCCI and EC2) currently supported
by OpenNebula are expected to be integrated soon in the StratusLab
distribution.

For what concerns the hypervisor, the most popular technologies like Xen, KVM
and VMware can potentially be used. In our specific setup for the reference
cloud service we use KVM.

What services are offered?
--------------------------

Currently StratusLab v1.2 and the respective reference cloud service give the
ability to instantiate and manage the lifecycle of virtual machines. For the
time being, no network management services are supported.

The [Marketplace][marketplace] is publicly accessible and currently offers
base OS images for various Linux distributions including:

* ttylinux 9.7
* CentOS 5.5
* Fedora 14
* Ubuntu 10.04 Server

With time, more base images as well as virtual appliances will become
available. External users also have the ability to upload their own base
images and appliances to the repository. For instructions on how to prepare
your own appliance and upload it on the StratusLab Marketplace consult the
[tutorial][tutorial].

At the time a user may instantiate VMs with the following hardware profiles:

    Type        CPUs     RAM         SWAP      
    m1.xlarge   2        1024 MB     1024 MB   
    m1.small    1         128 MB     1024 MB   
    c1.medium   1         256 MB     1024 MB   
    c1.xlarge   4        2048 MB     2048 MB   
    m1.large    2         512 MB     1024 MB   

On what physical infrastructure is the reference cloud service running?
-----------------------------------------------------------------------

The cloud service is running on 16 dual quad core Intel Xeon E5520 nodes, with
HyperThreading enabled. One additional node is used as the service frontend.
In total, we provide 256 logical cores that can be used from by VM instances.
Each node is configured with 48 GByte main memory. The base OS we use is Linux
Fedora 14.

Storage is provided by a centralized storage server which currently serves a
total of 3 TByte of storage shared among all the nodes with NFSv3.

What is the firewall policy?
----------------------------

No firewall restrictions are applied externally to the VMs. All ports are open
for end-user applications. Users are responsible to configure their own port
restrictions inside the VM images and for the overall security of the image in
general.

What Quality of Service is provided?
------------------------------------

Currently the StratusLab cloud services are provided as is with no guarantees
about the availability and stability of the service. We are making the best
effort to provide a stable cloud infrastructure but at the moment we cannot
guarantee that a VM instance might not crash or temporarily be unavailable due
to a software or network problem. As the distribution matures the
infrastructure is expected to become more stable and reliable. Our final goal
is to offer a high-quality production cloud service.

How can I deploy my own cloud service?
--------------------------------------

You can use StratusLab distribution v1.0 to deploy your own cloud services.
The software is open source and available from the project repositories.
Currently we support Fedora14 operating system and two modes of installation:

  - [Manual Installation][manual-install], or
  - [Quattor Installation][quattor-install].

How can I get more information and support?
-------------------------------------------

You should direct any enquiries related to the above services to
support@stratuslab.eu. Please use the same contact for reporting problems or
requesting any special arrangements for the cloud service setup. Notice that
as with the infrastructure itself the support services are currently provided
on best effort basis.

[grnet]: http://www.grnet.gr
[tcd]: http://www.tcd.ie 
[igtf]: http://www.igtf.net/
[get-started]: http://stratuslab.eu/doku.php/release:users
[one]: http://www.opennebula.org 
[marketplace]: https://marketplace.stratuslab.eu
[tutorial]: http://stratuslab.eu/doku.php/tutorial:usertutorial 
[manual-install]: http://stratuslab.eu/doku.php/tutorial:manualinstall
[quattor-install]: http://stratuslab.eu/doku.php/quattorinstall