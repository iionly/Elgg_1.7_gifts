Elgg Gifts Plugin
Contact: iionly@gmx.de
License: GNU General Public License version 2
Copyright: (c) iionly, Galdrapiu, Christian Heckelmann


Elgg Gifts Plugin Changelog
Current Version: 0.2.0
Released: 2010-06-30
Author:   iionly (iionly@gmx.de)
Copyright: (c) iionly 2012

v0.2.0 2010-6-30
    + Compatibility with Elgg 1.7+


Elgg Gifts Plugin Changelog
Current Version: 0.1.2
Released: 2009-09-19
Author:   Galdrapiu
Copyright: (c) Galdrapiu 2009

v0.1.2 2009-09-18

    + Accessright


Elgg Gifts Plugin Changelog
Current Version: 0.1.1
Released: 2009-09-07
Author:   Christian Heckelmann (checkelmann@gmail.com)
Copyright: (c) Christian Heckelmann 2009

v0.1.1 2009-09-07
    + Fix: IE8 Send Button not working

v0.1.0 2009-09-07
    + Add: River icon
    + Add: New administration area
    + Add: Write a message to your gift
    + Add: "Sent gifts"-page
    + Add: Upload pictures for gifts
    + Add: Gifts Widget for profile
    + Fix: My Gifts Page not showing all my gifts
    + Fix: Gift URL was wrong on river
    + Add: Gift preview
    + Add: You can configure if the "All Gifts"-page is shown
        + Add: Userpoint API Support

v0.0.2 2009-09-02
    + Better River Support (thanks to DDFUSION)
    + Add: Mail Notification for new gifts
    + Add: User Profile Menu Item "Send gift"
    + Removed noimage notification for gifts with no imagefile

v0.0.1 2009-09-01
    + Initial Release


Installation:

1. Copy the gifts plugin folder into you mod folder
2. !!!! Set the folder permissions of gifts/images to be writeable by the webserver (chmod 777) !!!!
3. Enable the gifts plugin in your "Tool Administrator"
5. Configure your Gifts in the Gifts Settings

Important!
If you are using a version below 0.1.0 and uploaded pictures to the images folder,
you have to upload the pictures again within the Gifts admin menu

!!! Please check the permissions of the images directory !!!
=======================================================
For RTL languages change left to right in gifts/views/default/gifts/css.php
from
.river_user_gifts {
    background:transparent url(<?php echo $vars['url']; ?>mod/gifts/river_icon_gifts.gif) no-repeat scroll left -1px;
}

to
.river_user_gifts {
    background:transparent url(<?php echo $vars['url']; ?>mod/gifts/river_icon_gifts.gif) no-repeat scroll right -1px;
}
