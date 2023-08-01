# UserRights Link
This extension displays a link to Special:UserRights in user listings for privileged users.
For example: `Username (talk | contribs | block | rights)`.

## Requirements
- MediaWiki 1.39+
- PHP 7.4+

## Installation
1. Extract the files into your wiki's `extensions/` directory and rename the extension directory to `UserRightsLink`.
2. Add `wfLoadExtension( 'UserRightsLink' );` to your `LocalSettings.php` file.
