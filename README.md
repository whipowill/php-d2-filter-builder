# Loot Filter Builder

A standalone PHP app that uses game data files to build complex loot filter rules for Diablo II.  This is pretty nerdy stuff that only the most dedicated D2 players will care about or find interesting.

- Highlights the absolute ideal base items for runewords.
- Tells you if you should Larzuk socket an item or cube socket an item:
	- If the item is showing runewords in the description, you should Larzuk socket it.
	- If the item has a socket recipe in the description, you should cube socket it.
- Adds an item description w/ what runewords you can make w/ a socketed item.
- Adds an item score to unique and set items as compared to perfect:
	- A score of ``4`` is perfect.
	- A score of ``3`` is almost perfect.
	- A score of ``2`` is mid range.
	- A score of ``1`` is low range.
	- Scoring is limited to the lowest common denominator, so even if the item is perfect in one aspect but terrible in another, the score will be low.

See [output.txt](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/output.txt) for the output of this program as run w/ my preferences.

## Usage

Edit [runewords.php](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/config/runewords.php) to adjust your preferred item types for each runeword, then run the script from terminal:

```bash
$ git clone git@github.com:whipowill/php-d2-lfb.git
$ cd php-d2-lfb
$ php run
```

Open the file [output.txt](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/output.txt) and copy the content into your ``BH.cfg`` loot filter config.

## Sources

- [Sockets.csv](https://diablo2.diablowiki.net/Sockets) - A spreadsheet of possible sockets from Larzuk based on item and item level.
- [Items.csv](https://raw.githubusercontent.com/dkuwahara/OmegaBot/master/data/item_data.txt) - A spreadsheet of all the items in the game w/ their item code.
- [Properties.csv](https://raw.githubusercontent.com/whipowill/php-d2-lfb/master/storage/properties.csv) - A spreadsheet I painstakingly compiled translating game stat codes to loot filter stat codes.

## Issues

- ``STAT31`` doesn't seem to work properly in the loot filter, so items w/ ``+N Defense`` aren't going to register against perfection.
- The loot filter item scoring is based on there only being one unique or set item per item type, so item types w/ more than one unique version won't score (rings, ammys, Ancient Armor).
- The loot filter doesn't allow me to build a rule based on the runeword, so I can't add item scoring to runewords.
- I haven't completed translating the game codes for some of the +skill items, so those may not score correctly yet.

## References

- [Luigi's Reddit Post](https://www.reddit.com/user/luigi13579/comments/phxd1g/diablo_ii_base_guide/)
- [ChaosNecromance's D2net Post](https://www.diabloii.net/forums/threads/iso-base-item-guide-for-runeword-creation.403767/)
- [Maxroll's Recommendations](https://d2.maxroll.gg/items/runewords)
- [SlashDiablo's Loot Filter Conditions](https://github.com/planqi/slashdiablo-maphack/wiki/Advanced-Item-Display#other-conditions)
- [Path of Diablo's Loot Filter Cheatsheet](https://wiki.projectdiablo2.com/wiki/Item_Filtering)