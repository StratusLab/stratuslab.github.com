---
layout: article
title: Development Roadmap
category: review
---

At their recent workshop, the StratusLab developers laid out the
roadmap for the upcoming releases for May (13.05) and August (13.08).
They've adopted a new architecture that will allow more scalable and
robust StratusLab clouds, while simplifying their deployment and
management.

Despite some rather major changes, the command line interface will
remain stable to avoid disruptions for users.  The four high-level
goals for these releases are:

* Move to database-centered architecture,
* Use libvirt directly for VM management, removing OpenNebula,
* Use CIMI as our native REST API, and
* Provide a management dashboard.

In addition to these overarching goals, the roadmap contains a number
of smaller changes that will improve the functionality of services and
make the services easier to use.  The following sections provide
details for each area of the StratusLab cloud distribution.

Architecture
------------

The StratusLab developers have decided to move towards an architecture
centered on a distributed document database.  The following schematic
diagram shows the new architecture:

<img width="600px" src="http://stratuslab.eu/img/high-level-architecture-2.png" />

The main reason for this change is to improve the scalability of the
StratusLab distribution.  Centering the architecture on a distributed
database allows the frontend, VM host, and storage nodes to be
easily replicated as the load and resource requirements increase.

We've decided to use [Couchbase][couchbase] for the database.  Good
APIs exist for Java and Python (two core languages for StratusLab) and
the document-oriented functionality matches well the resource format
and structure that will be used for CIMI.

[CIMI][cimi] is a major feature of the new architecture.  This new
standard API will become the native REST interface for all of the
StratusLab services.


Client Commands and APIs
------------------------

The REST API for the StratusLab services will change drastically over
the next couple of releases; however, users of the higher-level
Libcloud API and command line interface should be protected from these
changes.  These changes will take place incrementally over the 13.05
and 13.08 releases.

### Command Line Interface

The Command Line Interface (CLI) will remain stable over the next
couple of releases, although new commands and options may appear.
Users should not need to change their scripts (or habits) as the next
couple of releases are deployed. 

### Libcloud API

The Libcloud API will also remain stable, except for tracking changes
in the Libcloud specification.  Users should not need to change their
programs for the next couple of StratusLab releases.

### REST API

Over the next two releases, the services will migrate towards having
CIMI as their native rest interface.  Although semantically CIMI is
very similar to the current StratusLab REST API, the details are
significantly different and programs using the current REST API will
need to be rewritten.

### Other Interfaces

StratusLab developers are working with various other groups to provide
OCCI, EC2, and DIRAC interfaces.  These are all experimental
prototypes that are not officially supported by the project.  While
feedback on these prototypes is welcome, we can't make any guarantees
about support for them.  In all cases, these prototypes should not be
used in production systems.


Resources
---------

The planned changes for the resource services (compute, storage, and
network) will make them more reliable and easier to manage.  These
changes will generally not be directly visible by the users. 

### Compute (13.08)

OpenNebula will be removed from the StratusLab distribution.
Currently we're essentially using OpenNebula as an interface to
libvirt.  Removing OpenNebula and directly using libvirt will
significantly reduce the complexity of StratusLab. 

### Storage (13.05, 13.08)

The way the storage (pdisk) service interacts with physical storage
will be significantly reworked to make it more compatible with
high-performance storage appliances and with libvirt.  This again will
significantly reduce the complexity of these services and improve
reliability.

### Network (13.05)

The 'private' network class will be removed.  This is little used and
creates extra work for administrators.  The 'public' and 'local'
classes will remain.


Image Management
----------------

### Multiple Marketplaces (13.05)

One fundamental change for image management is how the Marketplace
instance is defined.  Currently, only one Marketplace can be used and
it is defined by both the cloud administrator and the user--possibly
inconsistently!

All of the StratusLab tools will be updated to allow a list of
Marketplace servers to be used.  The list of Marketplaces will be
defined by the cloud administrator and made available to clients
through the command line interface (CLI) and APIs.  This will allow
sites to have both private and public Marketplaces to tune the
visibility of the registered images.

The Marketplace configuration option for the CLI will only define the
Marketplace used to upload new metadata entries.  All other commands
will use the list of Marketplace servers provided by the cloud
administrator.

### Replication (13.08)

The Marketplace will be updated to use a git repository for the
primary storage of the image metadata entries.  This will allow
deployment of redundant Marketplace servers that can be easily
synchonized.

This will work with the previous feature to avoid having the public
Marketplace as a single point of failure.

### Metadata Schema Updates (13.05)

The metadata management functions will support a new element in the
image descriptions--**alternative** (in [Dublin Core terms][dcterms]
namespace).  This will provide an alternative name for an image.  This
will be used to provide a stable URL for a series of related images.
For example, the latest ubuntu image from StratusLab would have a
stable URL like:

    https://marketplace.stratuslab.eu/metadata/images@stratuslab.eu&tag=ubuntu

As security patches and updates are applied, this URL will remain
stable, although the underlying image identifiers will change.

The metadata schema will also be updated to allow image creators to
specify the types of accounts that are configured by default in the
image and the minimum resource requirements (e.g. minimum RAM).  This
will allow the cloud software to more intelligently handle user
requests.

### Updated Images (13.05 and 13.08)

With each release, the StratusLab base images will be updated to
reflect patches available in the various operating system
distributions.  We will also switch to using a more descriptive
endorser for those images (images@stratuslab.eu) and images tags to
support the stable URLs for these images.


Dashboard
---------

One consistent complaint from cloud administrators is that getting an
overview of activity on a cloud infrastructure is difficult.  It
currently requires using a variety of command line interfaces and
looking in log files from different services.

One major new service will be a management dashboard.  This will
collect information stored in the distributed database and present it
in a unified manner for the cloud administrator.

Related to this, various probes will need to be developed to push
information into the database.  In the short term, these probes will
concentrate on VM resource use, allowing an overview of resource use
and eventually accounting.  Probes for VM logs will also be created so
that both administrators and users can see the VM progress. 

An initial dashboard will be present in the 13.05 release; a more
complete service will appear in 13.08.


Conclusions
-----------

The next six months will be very busy to implement all of these
changes, but this effort will be worth it!  The future releases will
be more scalable, reliable, and will present a standardized REST
interface for the cloud services.


[couchbase]: http://www.couchbase.com/
[cimi]: http://dmtf.org/sites/default/files/standards/documents/DSP0263_1.0.1.pdf
[dcterms]: http://dublincore.org/documents/dcmi-terms/
