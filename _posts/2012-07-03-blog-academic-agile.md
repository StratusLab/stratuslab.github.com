---
layout: article
title: Academic Agile
category: blog
---

StratusLab used agile software development methodologies to produce a large
number of solid public releases over two years. Our experience demonstrates
that these methodologies can be used effectively in academic settings with a
distributed development team.

Agile Development
-----------------

Development process that is _adaptable_, _rapid_, and maintains _quality_.
There are many "theologies" (Scrum, [Kanban][kanban], [Lean][lean], etc.) and
techniques ([Test Driven Development][tdd], [eXtreme Programming][xp], pair
programming, code reviews, etc.) related to agile development. The important
feature is to manage _both_ human interactions and development techniques to
make development flow as rapidly and effortlessly as possible.

Scrum
-----

For StratusLab, the project chose to use [Scrum][scrum] for its software
development. At the core, Scrum is an iterative development process with each
iteration called a "sprint". Each sprint begins with a planning meeting and
ends with a demonstration. During the sprint, there is a daily meeting called
a "stand-up" that lasts a maximum of 15 minutes.

By design, Scrum manages the interactions between the people developing and
using a software package.  Specifically three roles are defined:

* Product Owner: Sets long- and short-term the development priorities for the
  software, by identifying desired functionality and indicating the relative
  importance of those features.

* Sprint Manager: Manages the sprint itself, chairing the planning, daily, and
  demonstration meetings and ensuring that any identified impediments for the
  development are removed.

* Team Members: Develop the software and related documentation, providing
  feedback on the requested features and identiied tasks.

A Scrum board (usually a whiteboard with post-it notes) containing the tasks
for the current sprint provides the focus of the human interactions. The goal
is to end each sprint with the majority of tasks completed _and demonstrated_,
resulting in a working increment to the software being developed.

StratusLab Results
------------------

The StratusLab project used Scrum for the full, two-year duration of the
project. In that time, the project made 12 public releases and implemented
nearly 600 features ("user stories") in 26 sprints. Each sprint lasted three
weeks on average. This is remarkable productivity for any project and we
believe is largely the result of our adoption of agile methodologies.

However to achieve this, the Scrum practices needed to be adapted to the
realities of the StratusLab collaboration. Although the process was very
efficient, we did have some recurring problems. The following sections provide
more information on the modifications to the process and the issues we had.

Customizing the Scrum Practices
-------------------------------

Standard Scrum usually involves development teams whose members are co-located
and work for a single company or institute. For StratusLab neither of these
are true. The project consisted of 15-30 developers spread among the six
partner institutes (and five countries!). Moreover, the developers worked
directly for the institutes and not the project itself, so solutions and/or
practices could not be imposed on the developers.

Having a common, physical Scrum board and a physical meeting with all
participants each day was clearly impossible. Instead we used JIRA/Greenhopper
for a virtual Scrum board and teleconferencing for the daily stand-up
meetings. Largely because of the teleconferencing, the daily meetings were
less focused on the Scrum board than would normally be the case. Nonetheless,
all developers described their progress, current development, and any
impediments during the meeting. These meetings quickly became the heartbeat of
the project.

An important part of any development effort are informal interactions between
the developers themselves. Water cooler or hallway conversations took place
instead via Skype. This proved to be an effective means of working through
particular problems while also allowing others to be brought in as needed.
Simple teleconferences were also used for the planning meetings.

For the demonstration meetings, however, sharing a screen between the
participants was mandatory. The project used EVO for this, despite the low
quality and large number of problems that were encountered. The main
attraction was EVO's support for Mac OS X, Windows, and Linux systems.

Even with the large number of tele- and video-conferences, face-to-face
meetings were essential. The project held workshops approximately every six
months. This allowed the developers to interact more directly with one
another. We also found that this periodic direct human interaction improved
the more frequent electronic interactions.

An important feature of Scrum is that the developers select tasks and commit
to implementing them. Not having all of the developers with a common "boss"
meant that tasks or the overall process could not be imposed on developers.
This turned out to be a blessing in disguise as the developers has to commit
to both; they were more engaged in the development process and finally more
productive.

Recurring Problems
------------------

The area where we had the most problems was related to release management.
Specifically, creating all of the release packages and fully certifying the
full cloud distribution.

We never managed to fully integrate the release procedures into the sprints.
The creation of the packages was always done in an _ad hoc_ manner after a
sprint, even though this was partially automated with our build and test
toolset. Perhaps a better strategy here would have been to alternate normal
sprints with short release sprints. This would have eliminated some of the
tension between the desire for further development and the need to package and
release the current software.

Initially there was no real certification of the releases. Problems
encountered in production were fed back into the next sprint's developments.
However, this made upgrading a risky business. Eventually, a formal
certification procedure that included both an upgrade of an existing
installation and a fresh installation were performed. This eliminated many
simple issues and provided better documentation to system administrators. As
for the release procedure as a whole, this was never well integrated with the
sprint cycle.

Conclusions
-----------

Overall, the experience with agile development methodologies, specifically
Scrum, was an extremely effective for the project. The project made a large
number of solid public releases over two years. Achieving this remarkable
level of productivity required tailoring the Scrum practices to the
constraints of the collaboration. Nonetheless the StratusLab experience
demonstrates that agile methodologies can be used effectively in a distributed
collaboraton in an academic environment.

[kanban]: https://some-link.example.com
[lean]: https://some-link.example.com
[tdd]: http://some-link.example.com
[xp]: http://some-link.example.com
[scrum]: https://some-link.example.com
