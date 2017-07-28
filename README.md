Joomla Contributors
=====================

A small Joomla! module to show (some of) the contributors to the Joomla! project.

Written by Simon Champion, July 2017.


Introduction
------------

Joomla! has hundreds of contributors. At the time of writing this, there are over 350 individuals recorded who have directly contributed code changes. There are hundreds more who have contributed to testing, documentation, feature suggestions, and more. It feels only just that we should celebrate these people.

Github provides an API that allows us to query the list of contributors; ie those who have contributed code. This module uses that API to thank these individuals by displaying their user avatars in the admin panel.


Dependencies
------------

* Joomla!

Note that this extension has only been tested against the current version of Joomla! (3.7.4 at the time of writing).


Installation
------------

This module should be installed via the Extensions manager in Joomla!'s admin panel.


Setup
-----

Once installed, go the configuration panel for the module by navigating Joomla!'s admin menu to Extensions / Modules, and then switching to list the Administration modules (rather than the Site modules per the default).

Then find the Joomla Contributors module the list of modules and click on it.

You will now get the config screen for the module, which contains the following fields:

* Contributors to display (default = 40)

  This is the number of avatars to display in the panel. If you want to display all contributors, you could set this to the same as the next field (Contributors to load). However by default, it is set to only show 40 avatars, to avoid taking up too much space.


* Contributors to load (default = 400)
  
  This tells the module how many contributor records to load from the API, in steps of 100. By default, this is set to 400, which means that all current contributors (at the time of writing) are loaded. This is irrespective of how many are actually displayed, as we can use a random sort order (see below) to allow all contributors to be shown. The API responds quickly and the results are cached, so this should not need to be changed. Reducing this number will mean that users with fewer contributions will be excluded from the results. Conversely, it may be necessary to increase it if more people start contributing to the project. Note, however, that the Github API will not return any more than a maximum of 500 contributors.

  
* Sort order (default = Weighted Random)

  We can use this field to specify one of three options:

  *Top Contributors* - This option simply displays the avatars for the users with the largest number of contributions. The users shown will always be the same.

  *Weighted Random* - This option displays a random selection of contributors, but with a weighting in favour of those with more contributions. This gives proper credit to the most active contributors, while still making it possible for those with fewer contributions to appear.

  *Random* - This option is a pure random shuffle, without any consideration to the number of contributions made.

* Avatar Size (default = 50)
  This specifies the size of the avatar graphics in pixels. You can adjust this as necessary to suit your screen size and admin template.


Once you've selected your options, set the status to 'Published', set the position to 'cpanel', and hit 'Save'. Now return to your Joomla admin panel home page to see the module in action.


Who wrote this?
---------------

This code was written by Simon Champion.

All code in this repository is released under the GPLv2 licence. The GPLv2 licence document should be included with the code.


Support
-------

Please use the Github issues tracker to report any bugs or feature requests.



Caveats and known issues
------------------------

* Full disclosure: The author of this module is a contributor to Joomla (albeit a minor one), and may thus show up in the panel.
* The correct functioning of this module is obviously dependant on the Github API remaining online and unchanged. The API results are cached, but if Github goes down that won't save it for long.
* Repeated re-loading will result in Github hitting you with a rate-limit ban. The caching should help with this. In the event of a ban, the module will still load but will not show any avatars.
* I acknowledge that this module only shows code contributors to the core, and that many other people have contributed to Joomla via other routes. This module may not put them in the spotlight, but I would like to publically thank them here for all that they do.


Todo
----


Trademarks and Licenses
-----------------------

* Joomla!® is a registered trademark of Open Source Matters, Inc.
* Joomla! is distributed under the GPLv2 licence.
* This package is distributed under the GPLv2 licence. The GPLv2 licence document should be included with the code.
