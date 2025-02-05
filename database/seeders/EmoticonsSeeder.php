<?php

namespace Database\Seeders;

use App\Models\Emoticon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmoticonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Emoticon::create([
            'code' => urlencode('😀'),
            'description' => 'Cara sonriente'
        ]);

        Emoticon::create([
            'code' => urlencode('😂'),
            'description' => 'Cara que llora de risa'
        ]);

        Emoticon::create([
            'code' => urlencode('👏🏼'),
            'description' => 'Aplausos'
        ]);

        Emoticon::create([
            'code' => urlencode('😃'),
            'description' => 'Cara sonriente con ojos abiertos.'
        ]);

        Emoticon::create([
            'code' => urlencode('😄'),
            'description' => 'Cara sonriente con ojos cerrados.'
        ]);

        Emoticon::create([
            'code' => urlencode('😁'),
            'description' => 'Cara sonriente que muestra los dientes.'
        ]);

        Emoticon::create([
            'code' => urlencode('😆'),
            'description' => 'Cara sonriente con ojos arrugados.'
        ]);

        Emoticon::create([
            'code' => urlencode('😅'),
            'description' => 'Cara sonriente con sudor frío.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤣'),
            'description' => 'Cara que se revuelve de la risa con ojos arrugados.'
        ]);

        Emoticon::create([
            'code' => urlencode('😊'),
            'description' => 'Cara feliz con ojos cerrados.'
        ]);

        Emoticon::create([
            'code' => urlencode('😇'),
            'description' => 'Cara sonriente con aureola.'
        ]);

        Emoticon::create([
            'code' => urlencode('🙂'),
            'description' => 'Cara ligeramente sonriente.'
        ]);

        Emoticon::create([
            'code' => urlencode('🙃'),
            'description' => 'Cara sonriente al revés.'
        ]);

        Emoticon::create([
            'code' => urlencode('😉'),
            'description' => 'Cara que guiña el ojo.'
        ]);

        Emoticon::create([
            'code' => urlencode('😌'),
            'description' => 'Cara de alivio.'
        ]);

        Emoticon::create([
            'code' => urlencode('😍'),
            'description' => 'Cara sonriente con ojos de corazón.'
        ]);

        Emoticon::create([
            'code' => urlencode('🥰'),
            'description' => 'Cara sonriente con corazones.'
        ]);

        Emoticon::create([
            'code' => urlencode('😘'),
            'description' => 'Cara que lanza un beso.'
        ]);

        Emoticon::create([
            'code' => urlencode('😗'),
            'description' => 'Cara que da un beso.'
        ]);

        Emoticon::create([
            'code' => urlencode('😙'),
            'description' => 'Cara que da un beso con los ojos cerrados.'
        ]);

        Emoticon::create([
            'code' => urlencode('😚'),
            'description' => 'Cara que da un beso con los ojos sonrientes.'
        ]);

        Emoticon::create([
            'code' => urlencode('😋'),
            'description' => 'Cara que saborea comida.'
        ]);

        Emoticon::create([
            'code' => urlencode('😛'),
            'description' => 'Cara con la lengua afuera.'
        ]);

        Emoticon::create([
            'code' => urlencode('😝'),
            'description' => 'Cara con los ojos arrugados y la lengua afuera.'
        ]);

        Emoticon::create([
            'code' => urlencode('😜'),
            'description' => 'Cara que guiña un ojo y saca la lengua.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤪'),
            'description' => 'Cara torcida con ojos que miran para lugares diferentes con la lengua afuera.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤨'),
            'description' => 'Cara con una ceja levantada.'
        ]);

        Emoticon::create([
            'code' => urlencode('🧐'),
            'description' => 'Cara con monóculo.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤓'),
            'description' => 'Cara sonriente con lentes y un solo diente.'
        ]);

        Emoticon::create([
            'code' => urlencode('😎'),
            'description' => 'Cara sonriente con lentes de sol.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤩'),
            'description' => 'Cara sonriente con estrellas en los ojos.'
        ]);

        Emoticon::create([
            'code' => urlencode('🥳'),
            'description' => 'Cara de fiesta.'
        ]);

        Emoticon::create([
            'code' => urlencode('😏'),
            'description' => 'Cara que sonríe con superioridad.'
        ]);

        Emoticon::create([
            'code' => urlencode('😒'),
            'description' => 'Cara de desaprobación.'
        ]);

        Emoticon::create([
            'code' => urlencode('😞'),
            'description' => 'Cara desanimada.'
        ]);

        Emoticon::create([
            'code' => urlencode('😟'),
            'description' => 'Cara preocupada.'
        ]);

        Emoticon::create([
            'code' => urlencode('😕'),
            'description' => 'Cara de confusión.'
        ]);

        Emoticon::create([
            'code' => urlencode('🙁'),
            'description' => 'Cara con el ceño ligeramente fruncido.'
        ]);

        Emoticon::create([
            'code' => urlencode('☹️'),
            'description' => 'Cara con el ceño fruncido.'
        ]);

        Emoticon::create([
            'code' => urlencode('😖'),
            'description' => 'Cara de frustración.'
        ]);

        Emoticon::create([
            'code' => urlencode('😫'),
            'description' => 'Cara de desesperación.'
        ]);

        Emoticon::create([
            'code' => urlencode('😩'),
            'description' => 'Cara de agotamiento.'
        ]);

        Emoticon::create([
            'code' => urlencode('🥺'),
            'description' => 'Cara que pide por favor.'
        ]);

        Emoticon::create([
            'code' => urlencode('😢'),
            'description' => 'Cara de llanto.'
        ]);

        Emoticon::create([
            'code' => urlencode('😭'),
            'description' => 'Cara de llanto desconsolado.'
        ]);

        Emoticon::create([
            'code' => urlencode('😤'),
            'description' => 'Cara resoplando.'
        ]);

        Emoticon::create([
            'code' => urlencode('😠'),
            'description' => 'Cara enojada.'
        ]);

        Emoticon::create([
            'code' => urlencode('😡'),
            'description' => 'Cara muy enojada.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤬'),
            'description' => 'Cara con símbolos en la boca.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤯'),
            'description' => 'Cabeza que explota.'
        ]);

        Emoticon::create([
            'code' => urlencode('😳'),
            'description' => 'Cara sonrojada.'
        ]);

        Emoticon::create([
            'code' => urlencode('🥵'),
            'description' => 'Cara con calor.'
        ]);

        Emoticon::create([
            'code' => urlencode('🥶'),
            'description' => 'Cara con frío.'
        ]);

        Emoticon::create([
            'code' => urlencode('😱'),
            'description' => 'Cara que grita del miedo.'
        ]);

        Emoticon::create([
            'code' => urlencode('😨'),
            'description' => 'Cara asustada.'
        ]);

        Emoticon::create([
            'code' => urlencode('😰'),
            'description' => 'Cara con ansiedad y sudor.'
        ]);

        Emoticon::create([
            'code' => urlencode('😓'),
            'description' => 'Cara con sudor frío.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤗'),
            'description' => 'Cara con manos en gesto de abrazo.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤔'),
            'description' => 'Cara pensativa.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤭'),
            'description' => 'Cara con una manos sobre la boca.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤫'),
            'description' => 'Cara que pide silencio.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤥'),
            'description' => 'Cara que le creció la nariz.'
        ]);

        Emoticon::create([
            'code' => urlencode('😶'),
            'description' => 'Cara sin boca.'
        ]);

        Emoticon::create([
            'code' => urlencode('😐'),
            'description' => 'Cara neutral.'
        ]);

        Emoticon::create([
            'code' => urlencode('😑'),
            'description' => 'Cara sin expresión.'
        ]);

        Emoticon::create([
            'code' => urlencode('😬'),
            'description' => 'Cara que hace una mueca.'
        ]);

        Emoticon::create([
            'code' => urlencode('🙄'),
            'description' => 'Cara que revolea los ojos.'
        ]);



    }
}
