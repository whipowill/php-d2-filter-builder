# Loot Filter Builder

A standalone PHP app that uses data files to build complex loot filter rules for Diablo II.  This is pretty nerdy stuff that only the most dedicated D2 players will care about or find interesting.

## What This Does

Maphack in Diablo II comes with a loot filter w/ which you can assign "tiers" to items, and it will notify you when those items drop.  The guys over at SlashDiablo, who built maphack, include their own loot filter config that has some errors and isn't very easy to customize to your own tastes.  The loot filter rules can quickly get confusing bc every entry effects another entry, and it gets overwhelming.

I wrote this program to tame the loot filter rules by building perfect, audited, error checked, rulesets.  All you have to do is edit the spreadsheets in ``storage/`` to match your preferences for what item types you value.  These lists include all the set, unique, and runeword items in the game, all you have to do is add what tier you want each of these items to be, and what extra stats those items need to have to qualify.

- [config.php](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/config/config.php)
- [sets.csv](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/storage/sets.csv)
- [uniques.csv](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/storage/uniques.csv)
- [runewords.csv](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/storage/runewords.csv)

For each item in the game, you can define a ``tier`` for the item w/out special stats, and/or a ``tier_with_params`` for the item if it has the special stats.  So, for example, I have a normal Reapers Toll as a tier 4 item, but an ethereal Reapers Toll is a tier 2 item.  My settings for unique and set items are almost identical to the SlashDiablo settings, but the runewords is where things get more complicated.

When setting a tier for a runeword, you're not really assigning it to the runeword, you're assigning it to the base item w/ the right number of sockets.  Because so many runewords use the same items w/ the same sockets, the tier settings get messy really fast.  This program takes all the runeword tiers you define and it breaks them down by item.  It determines the ideal tier ranking for the base item and it strips out all the duplicates.

In the end, the output of this program is perfect loot filter rules, with deduped tier notifications for all the items you care about.  It adds id/noid, eth/noeth, and socket/nosocket variations as needed.  It adds recipe descriptions to all the runeword base items you defined, and it tells you if you should Larzuk socket or cube socket the item to get the number of sockets you want.

See [output.txt](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/output.txt) for the output of this program as run w/ my preferences.

## How To Use

Download the app:

```bash
$ git clone git@github.com:whipowill/php-d2-filter-builder.git
$ cd php-d2-filter-builder
```

Make any desired changes to the editable files, and run the app:

```bash
$ php run
```

Open the file ``output.txt`` and copy the contents into the bottom of your ``BH.cfg`` loot filter config.

## Issues

- There is a choice about what to do w/ unsocketed base items.  One option is to mark them as the most optimistic tier possible, the other option is to mark them as the lowest tier possible.  You just don't know how good or bad the item will actually be.  I wrote it into the config as to which option you want to use.

## References

- [Luigi's Reddit Post](https://www.reddit.com/user/luigi13579/comments/phxd1g/diablo_ii_base_guide/)
- [ChaosNecromance's D2net Post](https://www.diabloii.net/forums/threads/iso-base-item-guide-for-runeword-creation.403767/)
- [Maxroll's Recommendations](https://d2.maxroll.gg/items/runewords)
- [SlashDiablo's Loot Filter Tier Selections](https://raw.githubusercontent.com/youbetterdont/bhconfig/master/BH.cfg)
- [SlashDiablo's Loot Filter Conditions](https://github.com/planqi/slashdiablo-maphack/wiki/Advanced-Item-Display#other-conditions)
- [Path of Diablo's Loot Filter Cheatsheet](https://wiki.projectdiablo2.com/wiki/Item_Filtering)