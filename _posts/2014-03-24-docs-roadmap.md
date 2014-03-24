---
layout: article
title: Development Roadmap
category: documentation
---

The last few releases of the StratusLab cloud distribution have been
primarily bug fix releases that have addressed issues raised by
StratusLab users and administrators.  The next release, scheduled
for the beginning of June, will contain more fundamental changes to
improve the security, scalability, and functionality.

Improving Security
------------------

Security has always been an important point in the development of the
StratusLab cloud distribution.  Nonetheless, modifications to the code
base to follow current best practices and to change the deployment
model can improve the overall security of StratusLab clouds.

### Deployment Model

Currently, all of the StratusLab services run on their own default
ports and are accessed directly by clients.  The deployment model will
change to using a common proxy service running on SSL port 443 to
access all StratusLab services on the machine.

For users, this will avoid problems with local firewalls that block
access to the variety of ports used by the current StratusLab
services.  For administrators, this will reduce the number of service
certificates needed.

This deployment model allows direct access to services to be more
tightly controlled, allows services to run in non-priviledged
accounts, and provides a smoother upgrade path for users if more
StratusLab services appear in the future.

### Use of Non-root Accounts

In addition to the change in the deployment model, the StratusLab
services will now all run as normal users (since they no longer need
direct access to system ports).  This will limit the possible damage
should a service be compromised.  It will also require the StratusLab
developers to identify all of the cases in which services need
elevated priviledges.

Functional Changes
------------------

A number of functional changes will be implemented for the 14.06
release:

**Cloud-init**: StratusLab will move to using cloud-init
   contextualization by default.  This provides more flexibility to
   the users and allows appliances to be more easily shared with other
   clouds.  The ttylinux appliance will no longer be supported and
   will be replaced by another minimal linux distirbution.

**CIMI Storage**: The next release will use the CIMI interface for the
   storage service.  The client will be updated so that this change is
   transparent for the end-users.  This will provide a more flexible
   system to allow system administrators to support a larger variety
   of physical storage and to manage the storage more easily.

**Simplify Image Creation**: Use the storage service to transmit
 appliance metadata to simplify the entire process.  This avoids
 problems with lost emails and with pollution of test images in the
 central Marketplace. 

**Appliance Tags**: Ensure that the "tag" feature in the Marketplace
 works with all of the StratusLab services and appliances.  This
 allows users to use the latest version of an appliance in a series
 without having to look up the Marketplace identifier each time.

**Appliances**: All of the appliances will be updated with the latest
  releases and the switch to cloud-init as the default.  In addition
  the list of the supported appliances will be reviewed.
