<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author_id' => fake()->numberBetween(1, 11),
            'title' => fake()->text(50),
            'original_title' => fake()->text(50),
            'year' => fake()->year(),
            'description' => fake()->text(1000),
            'subtitle' => fake()->text(100),
            'language' => fake()->languageCode(),
            'class' => fake()->randomElement(['lyrika', 'epika', 'drama']),
            'genre' => fake()->randomElement(['abstrakt', 'absurdní drama', 'antiutopie', 'apokalypsa', 'apokryf', 'arabeska', 'autobiografie', 'bajka', 'balada', 'báseň v próze', 'beletrie', 'bildungsroman', 'biografický román', 'biografie', 'bondovka', 'brak', 'budovatelský román', 'bukolická poezie', 'bukolický román', 'burleska', 'bylina', 'cestopis', 'cch’', 'červená knihovna', 'četba na pokračování', 'čchü', 'činohra', 'črta', 'deník', 'detektivka', 'didaktická literatura', 'dobrodružná literatura', 'dopis', 'drabble', 'duma', 'dvojjazyčná kniha', 'ekloga', 'elegie', 'entrefilet', 'epigram', 'epika', 'epištola', 'epos', 'epyllion', 'ergodická literatura', 'erotická literatura', 'evangelium', 'fabliau', 'fantastika', 'fantasy', 'femininní žánry', 'filipika', 'filozofická povídka', 'fotokomiks', 'fraška', 'frenetická literatura', 'gazel', 'gotický román', 'groteska', 'hádanka', 'hagiografie', 'haiku', 'heroikomika', 'historická detektivka', 'historický román', 'humoreska', 'chansons de geste', 'chronotop', 'chua-pen', 'chvalozpěv', 'jednoaktovka', 'jüe-fu', 'kaligram', 'kancóna', 'kasída', 'knížecí zrcadla', 'knížky lidového čtení', 'kolportážní román', 'komedie', 'komedie mravů', 'komentář', 'komiks', 'krásná literatura', 'kronika', 'legenda', 'legenda', 'lejch', 'libreto', 'lidová slovesnost', 'limerik', 'literární kritika', 'literatura faktu', 'literatura pro děti', 'literatura pro děti a mládež', 'literatura pro mládež', 'lucidář', 'lyrická poezie', 'madrigal', 'mester de clerecía', 'mester de juglaría', 'měšťanské drama', 'metaromán', 'military science fiction', 'modus', 'monodická lyrika', 'muzeum v knize', 'mýtus', 'národní kronika', 'novela', 'noveleta', 'nový román', 'odborná literatura', 'odborný text', 'otrokářská povídka', 'paměti', 'pamflet', 'panegyrik', 'parodie', 'pastorála', 'pašije', 'pitaval', 'poezie', 'pohádka', 'polská literární reportáž', 'postila', 'pověst', 'povídka', 'povídka filozofická', 'proverb', 'próza', 'průpověď', 'průvodce', 'příležitostná poezie', 'psychologický román', 'rčení', 'recenze', 'rispet', 'román', 'román rodinného života', 'román v dopisech', 'román veršovaný', 'román-řeka', 'romance', 'romaneto', 'rondel', 'rozhlasová hra', 'rozhlasový dokument', 'rozpočítadlo', 'rozprava', 'rubáí', 'rytířský román', 'říkadlo', 'sága', 'sao', 'scénář', 'science fiction', 'senzační román', 'sestina', 'severská detektivka', 'skeč', 'snář', 'sonet', 'soudnička', 'space opera', 'speculum', 'subžánr', 'symposion', 'š’', 'tencóna', 'thriller', 'tragédie', 'traktát', 'travestie', 'true crime', 'ústní podání', 'utopie', 'úvaha', 'věnec sonetů', 'venkovská próza', 'veršovaný román', 'villonská balada', 'výklad', 'vyprávění', 'western', 'xenie', 'zpráva', 'žalm', 'žánr']),
            'number' => fake()->randomNumber(2)
        ];
    }
}
