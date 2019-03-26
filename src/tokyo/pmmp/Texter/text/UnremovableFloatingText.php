<?php

/**
 * // English
 *
 * Texter, the display FloatingTextPerticle plugin for PocketMine-MP
 * Copyright (c) 2018 yuko fuyutsuki < https://github.com/fuyutsuki >
 *
 * This software is distributed under "MIT license".
 * You should have received a copy of the MIT license
 * along with this program.  If not, see
 * < https://opensource.org/licenses/mit-license >.
 *
 * ---------------------------------------------------------------------
 * // 日本語
 *
 * TexterはPocketMine-MP向けのFloatingTextPerticleを表示するプラグインです
 * Copyright (c) 2018 yuko fuyutsuki < https://github.com/fuyutsuki >
 *
 * このソフトウェアは"MITライセンス"下で配布されています。
 * あなたはこのプログラムと共にMITライセンスのコピーを受け取ったはずです。
 * 受け取っていない場合、下記のURLからご覧ください。
 * < https://opensource.org/licenses/mit-license >
 */

declare(strict_types = 1);

namespace tokyo\pmmp\Texter\text;

use pocketmine\level\Position;
use pocketmine\Player;
use tokyo\pmmp\Texter\data\Data;

/**
 * Class UnremovableFloatingText
 * @package tokyo\pmmp\Texter\text
 */
class UnremovableFloatingText extends FloatingText implements Text {

  /** @var string */
  protected $owner = "uft.json";

  public function __construct(string $name, Position $pos, string $title = "", string $text = "", int $eid = 0) {
    parent::__construct($name, $pos, $title, $text, $this->owner, $eid);
  }

  public function sendToPlayer(Player $player, int $type = Text::SEND_TYPE_ADD): FloatingText {
    $pk = $this->asPacket($type);
    $player->sendDataPacket($pk);
    return $this;
  }

  public function format(): array {
    return [
      Data::KEY_X => sprintf('%0.1f', $this->x),
      Data::KEY_Y => sprintf('%0.1f', $this->y),
      Data::KEY_Z => sprintf('%0.1f', $this->z),
      Data::KEY_TITLE => $this->title,
      Data::KEY_TEXT => $this->text
    ];
  }

  public function __toString(): string {
    return "UnremovableFloatingText(name=\"{$this->text}\", pos=\"x:{$this->x};y:{$this->y};z:{$this->z};level:{$this->level->getFolderName()}\", title=\"{$this->title}\", text=\"{$this->text}\", eid=\"{$this->eid}\")";
  }
}