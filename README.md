# UnlimitedSlots

Allow players to join Axolotl-PM servers beyond the configured player limit

[![CI](https://github.com/NhanAZ-Plugins/UnlimitedSlots/actions/workflows/build.yml/badge.svg)](https://github.com/NhanAZ-Plugins/UnlimitedSlots/actions/workflows/build.yml)
[![Latest release](https://img.shields.io/github/v/release/NhanAZ-Plugins/UnlimitedSlots)](https://github.com/NhanAZ-Plugins/UnlimitedSlots/releases/latest)
[![License](https://img.shields.io/github/license/NhanAZ-Plugins/UnlimitedSlots)](https://github.com/NhanAZ-Plugins/UnlimitedSlots/blob/master/LICENSE)
[![Discord](https://img.shields.io/discord/986553214889517088?label=Discord&logo=discord&logoColor=white&color=5865F2)](https://discord.gg/j2X83ujT6c)

## Overview

This plugin targets the PocketMine-MP and Axolotl-PM API 5 ecosystem and is maintained under [NhanAZ-Plugins](https://github.com/NhanAZ-Plugins).

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
