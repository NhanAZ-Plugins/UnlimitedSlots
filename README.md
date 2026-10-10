# UnlimitedSlots

UnlimitedSlots lets players join an [Axolotl-PM](https://github.com/axolotl-pm/PocketMine-MP) server after its configured player limit has been reached. It removes the server-full reason during the prelogin event and advertises one available slot in legacy query responses.

The plugin leaves whitelist and ban decisions intact. Other plugins can still deny a login, and the server still needs enough resources to handle additional players. The plugin does not change Axolotl-PM's configured player limit.

## Requirements

- Axolotl-PM API 5.0.0. See the pinned source revisions and test results in the [build workflow](.github/workflows/build.yml) and [GitHub Actions runs](https://github.com/NhanAZ-Plugins/UnlimitedSlots/actions). Compatibility with every 5.x revision has not been verified.
- PHP 8.1 or newer, as required by Axolotl-PM 5.

## Installation

Download the PHAR from [GitHub Releases](https://github.com/NhanAZ-Plugins/UnlimitedSlots/releases), place it in the server's `plugins` directory and restart the server. The plugin has no configuration file.

## Development and validation

The [build workflow](.github/workflows/build.yml) runs admission policy tests against pinned Axolotl-PM source revisions. It then uses [DevTools](https://github.com/NhanAZ/DevTools) to run PHPStan at maximum level, build the plugin PHAR and validate the artifact. Exact tested revisions and build results are recorded in the workflow and its [GitHub Actions runs](https://github.com/NhanAZ-Plugins/UnlimitedSlots/actions).

The admission policy tests exercise the query and prelogin event behavior. A live Bedrock client joining a full server has not been tested.

## Support

Join [NhanAZ Discord](https://discord.gg/j2X83ujT6c) for support.

## License

UnlimitedSlots is distributed under the [MIT License](LICENSE).
