<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddFandomImagesToSequelResources extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->updateImages('people', [
			84 => ['https://static.wikia.nocookie.net/starwars/images/2/2b/Rey_TROS_Fathead.png', 'https://starwars.fandom.com/wiki/Rey_Skywalker'],
			85 => ['https://static.wikia.nocookie.net/starwars/images/1/1a/Finn-TSWB.png', 'https://starwars.fandom.com/wiki/Finn'],
			86 => ['https://static.wikia.nocookie.net/starwars/images/6/6b/PoeDameron-Heroes2023.png', 'https://starwars.fandom.com/wiki/Poe_Dameron'],
			87 => ['https://static.wikia.nocookie.net/starwars/images/6/68/BB8-Fathead.png', 'https://starwars.fandom.com/wiki/BB-8'],
			88 => ['https://static.wikia.nocookie.net/starwars/images/b/bc/KyloRenVFcover-TROS.png', 'https://starwars.fandom.com/wiki/Ben_Solo'],
			89 => ['https://static.wikia.nocookie.net/starwars/images/f/f0/Snoke-TLJOCE.png', 'https://starwars.fandom.com/wiki/Snoke'],
			90 => ['https://static.wikia.nocookie.net/starwars/images/5/53/MazKanata-TROSGG.png', 'https://starwars.fandom.com/wiki/Maz_Kanata'],
			91 => ['https://static.wikia.nocookie.net/starwars/images/d/d0/HuxTLJPromo.png', 'https://starwars.fandom.com/wiki/Armitage_Hux'],
			92 => ['https://static.wikia.nocookie.net/starwars/images/0/02/Phasma.png', 'https://starwars.fandom.com/wiki/Phasma'],
			93 => ['https://static.wikia.nocookie.net/starwars/images/a/a8/RoseTico-RotR.png', 'https://starwars.fandom.com/wiki/Rose_Tico'],
			94 => ['https://static.wikia.nocookie.net/starwars/images/8/83/Holdo-Portfolio.png', 'https://starwars.fandom.com/wiki/Amilyn_Holdo'],
			95 => ['https://static.wikia.nocookie.net/starwars/images/d/d5/TLJ-DJ-Movie-no.jpg', 'https://starwars.fandom.com/wiki/DJ'],
			96 => ['https://static.wikia.nocookie.net/starwars/images/7/78/Jannah-HeroesResistance.png', 'https://starwars.fandom.com/wiki/Jannah'],
			97 => ['https://static.wikia.nocookie.net/starwars/images/0/08/ZoriiBliss-TSWB.png', 'https://starwars.fandom.com/wiki/Zorii_Bliss'],
			98 => ['https://static.wikia.nocookie.net/starwars/images/9/91/D-O_Fathead.png', 'https://starwars.fandom.com/wiki/D-O'],
			99 => ['https://static.wikia.nocookie.net/starwars/images/d/d8/LorSanTekka-SWTimelines.png', 'https://starwars.fandom.com/wiki/Lor_San_Tekka'],
			100 => ['https://static.wikia.nocookie.net/starwars/images/b/b7/Unkar_Plutt-RO_U_Visual_Guide.png', 'https://starwars.fandom.com/wiki/Unkar_Plutt'],
			101 => ['https://static.wikia.nocookie.net/starwars/images/b/b8/Teedo-TFUVD.png', 'https://starwars.fandom.com/wiki/Teedo'],
			102 => ['https://static.wikia.nocookie.net/starwars/images/2/22/SnapWexley-SWI198.png', 'https://starwars.fandom.com/wiki/Temmin_Wexley'],
			103 => ['https://static.wikia.nocookie.net/starwars/images/c/c6/Kaydel_Ko_Connix_TROSOCE.png', 'https://starwars.fandom.com/wiki/Kaydel_Ko_Connix'],
			104 => ['https://static.wikia.nocookie.net/starwars/images/5/5a/CommanderDacy-ToppsFinest2023.png', 'https://starwars.fandom.com/wiki/Larma_D%27Acy'],
			105 => ['https://static.wikia.nocookie.net/starwars/images/0/07/General_Pryde_TROSOCE.png', 'https://starwars.fandom.com/wiki/Enric_Pryde'],
			106 => ['https://static.wikia.nocookie.net/starwars/images/9/95/Beaumont_Kin.png', 'https://starwars.fandom.com/wiki/Beaumont_Kin'],
			107 => ['https://static.wikia.nocookie.net/starwars/images/4/40/BabuFrik-ToppsFinest2023.png', 'https://starwars.fandom.com/wiki/Babu_Frik'],
			108 => ['https://static.wikia.nocookie.net/starwars/images/6/6e/Klaud-AdvancedGraphics.png', 'https://starwars.fandom.com/wiki/Klaud'],
		]);

		$this->updateImages('planets', [
			61 => ['https://static.wikia.nocookie.net/starwars/images/f/ff/Jakku-PoeDameronFlightLog.png', 'https://starwars.fandom.com/wiki/Jakku'],
			62 => ['https://static.wikia.nocookie.net/starwars/images/8/8d/StarkillerBaseCrop-FH.png', 'https://starwars.fandom.com/wiki/Starkiller_Base'],
			63 => ['https://static.wikia.nocookie.net/starwars/images/f/f6/Tak.png', 'https://starwars.fandom.com/wiki/Takodana'],
			64 => ['https://static.wikia.nocookie.net/starwars/images/f/f0/DQar_SWCT.png', 'https://starwars.fandom.com/wiki/D%27Qar'],
			65 => ['https://static.wikia.nocookie.net/starwars/images/0/04/Ahch-To_TLJTVD.png', 'https://starwars.fandom.com/wiki/Ahch-To'],
			66 => ['https://static.wikia.nocookie.net/starwars/images/d/da/Cantonica_TLJVD.png', 'https://starwars.fandom.com/wiki/Cantonica'],
			67 => ['https://static.wikia.nocookie.net/starwars/images/1/13/Crait_TLJVD.png', 'https://starwars.fandom.com/wiki/Crait'],
			68 => ['https://static.wikia.nocookie.net/starwars/images/4/40/Exegol-TROSTGG.png', 'https://starwars.fandom.com/wiki/Exegol'],
			69 => ['https://static.wikia.nocookie.net/starwars/images/4/4e/Kijimi-TROSTGG.png', 'https://starwars.fandom.com/wiki/Kijimi'],
			70 => ['https://static.wikia.nocookie.net/starwars/images/1/1b/Pasaana-TROSGG.png', 'https://starwars.fandom.com/wiki/Pasaana'],
			71 => ['https://static.wikia.nocookie.net/starwars/images/d/d8/KefBir.jpg', 'https://starwars.fandom.com/wiki/Kef_Bir'],
			72 => ['https://static.wikia.nocookie.net/starwars/images/a/a3/Ajan-Kloss-TROS-GG.png', 'https://starwars.fandom.com/wiki/Ajan_Kloss'],
		]);

		$this->updateImages('species', [
			38 => ['https://static.wikia.nocookie.net/starwars/images/d/d2/CaiThrenalli-CGSWG.png', 'https://starwars.fandom.com/wiki/Abednedo'],
			39 => ['https://static.wikia.nocookie.net/starwars/images/7/7d/UnkarPlutt-CGSWG.png', 'https://starwars.fandom.com/wiki/Crolute'],
			40 => ['https://static.wikia.nocookie.net/starwars/images/c/c9/BabuFrik-TROS.png', 'https://starwars.fandom.com/wiki/Anzellan'],
			41 => ['https://static.wikia.nocookie.net/starwars/images/3/3d/Vexis-CGSWG.png', 'https://starwars.fandom.com/wiki/Vexis'],
		]);

		$this->updateImages('starships', [
			76 => ['https://static.wikia.nocookie.net/starwars/images/e/ee/T70XwingStarfighter-SWBC41.png', 'https://starwars.fandom.com/wiki/T-70_X-wing_starfighter'],
			77 => ['https://static.wikia.nocookie.net/starwars/images/9/97/TIEFOfighter-Fathead.png', 'https://starwars.fandom.com/wiki/TIE/fo_space_superiority_fighter'],
			78 => ['https://static.wikia.nocookie.net/starwars/images/d/d7/KyloRenCommandShuttle-Fathead.png', 'https://starwars.fandom.com/wiki/Upsilon-class_command_shuttle'],
			79 => ['https://static.wikia.nocookie.net/starwars/images/1/1e/ResistanceTransport-MF92.png', 'https://starwars.fandom.com/wiki/Resistance_transport'],
			80 => ['https://static.wikia.nocookie.net/starwars/images/9/93/FinalizerSD-Fathead.png', 'https://starwars.fandom.com/wiki/Finalizer'],
			81 => ['https://static.wikia.nocookie.net/starwars/images/c/ca/MC85-Star-Cruiser-Front.png', 'https://starwars.fandom.com/wiki/Raddus_(MC85_Star_Cruiser)'],
			82 => ['https://static.wikia.nocookie.net/starwars/images/3/3e/Supremacy-USWNE.png', 'https://starwars.fandom.com/wiki/Supremacy'],
			83 => ['https://static.wikia.nocookie.net/starwars/images/e/ef/TIE_Silencer_TFOWM.png', 'https://starwars.fandom.com/wiki/TIE/vn_space_superiority_fighter'],
			84 => ['https://static.wikia.nocookie.net/starwars/images/6/63/Bestoon_Legacy_TROSOCE.png', 'https://starwars.fandom.com/wiki/Bestoon_Legacy'],
		]);

		$this->updateImages('vehicles', [
			77 => ['https://static.wikia.nocookie.net/starwars/images/5/5e/LIUV-BF2.png', 'https://starwars.fandom.com/wiki/Light_Infantry_Utility_Vehicle'],
			78 => ['https://static.wikia.nocookie.net/starwars/images/a/ad/V-4X-D_Ski_Speeder_TLJ.png', 'https://starwars.fandom.com/wiki/V-4X-D_ski_speeder'],
			79 => ['https://static.wikia.nocookie.net/starwars/images/2/2e/Treadspeeder-CGSWG.png', 'https://starwars.fandom.com/wiki/125-Z_treadspeeder_bike'],
			80 => ['https://static.wikia.nocookie.net/starwars/images/b/bb/Orbak-TSWB.png', 'https://starwars.fandom.com/wiki/Orbak'],
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('people')->whereBetween('id', [84, 108])->update(['image_url' => null, 'image_source' => null]);
		DB::table('planets')->whereBetween('id', [61, 72])->update(['image_url' => null, 'image_source' => null]);
		DB::table('species')->whereBetween('id', [38, 41])->update(['image_url' => null, 'image_source' => null]);
		DB::table('starships')->whereBetween('id', [76, 84])->update(['image_url' => null, 'image_source' => null]);
		DB::table('vehicles')->whereBetween('id', [77, 80])->update(['image_url' => null, 'image_source' => null]);
	}

	private function updateImages($table, array $rows)
	{
		foreach ($rows as $id => $image) {
			DB::table($table)->where('id', $id)->update([
				'image_url' => $image[0],
				'image_source' => $image[1],
			]);
		}
	}
}
