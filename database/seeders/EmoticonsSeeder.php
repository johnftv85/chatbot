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

        Emoticon::create([
            'code' => urlencode('😯'),
            'description' => 'Cara estupefacta.'
        ]);

        Emoticon::create([
            'code' => urlencode('😮'),
            'description' => 'Cara con la boca abierta.'
        ]);

        Emoticon::create([
            'code' => urlencode('😲'),
            'description' => 'Cara asombrada.'
        ]);

        Emoticon::create([
            'code' => urlencode('🥱'),
            'description' => 'Cara de bostezo.'
        ]);

        Emoticon::create([
            'code' => urlencode('😴'),
            'description' => 'Cara durmiendo.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤤'),
            'description' => 'Cara que babea.'
        ]);

        Emoticon::create([
            'code' => urlencode('😪'),
            'description' => 'Cara de sueño.'
        ]);

        Emoticon::create([
            'code' => urlencode('😵'),
            'description' => 'Cara mareada.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤐'),
            'description' => 'Cara con cierre en la boca.'
        ]);

        Emoticon::create([
            'code' => urlencode('🥴'),
            'description' => 'Cara desencajada.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤢'),
            'description' => 'Cara de náuseas.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤮'),
            'description' => 'Cara que vomita.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤧'),
            'description' => 'Cara que se suena la nariz.'
        ]);

        Emoticon::create([
            'code' => urlencode('😷'),
            'description' => 'Cara con barbijo.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤒'),
            'description' => 'Cara con un termómetro en la boca.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤕'),
            'description' => 'Cara con un venda en la cabeza.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤑'),
            'description' => 'Cara con ojos y lengua de dinero.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤠'),
            'description' => 'Cara con sombrero de vaquero.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤲🏼'),
            'description' => 'Palmas juntas hacia arriba.'
        ]);

        Emoticon::create([
            'code' => urlencode('👐🏼'),
            'description' => 'Manos abiertas.'
        ]);

        Emoticon::create([
            'code' => urlencode('🙌🏼'),
            'description' => 'Manos levantadas que celebran.'
        ]);

        Emoticon::create([
            'code' => urlencode('👍🏻'),
            'description' => 'Pulgar hacia arriba.'
        ]);

        Emoticon::create([
            'code' => urlencode('👎🏼'),
            'description' => 'Pulgar hacia abajo.'
        ]);

        Emoticon::create([
            'code' => urlencode('👊🏼'),
            'description' => 'Puño cerrado.'
        ]);

        Emoticon::create([
            'code' => urlencode('✊🏼'),
            'description' => 'Puño en alto.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤛🏼'),
            'description' => 'Puño hacia la izquierda.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤜🏼'),
            'description' => 'Puño hacia la derecha.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤞🏼'),
            'description' => 'Dedos cruzados.'
        ]);

        Emoticon::create([
            'code' => urlencode('✌🏼'),
            'description' => 'Dedos en V.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤟🏼'),
            'description' => 'Gesto de te quiero.'
        ]);

        Emoticon::create([
            'code' => urlencode('👌🏼'),
            'description' => 'Señal de aprobación.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤏🏼'),
            'description' => 'Mano que pellizca.'
        ]);

        Emoticon::create([
            'code' => urlencode('👈🏼'),
            'description' => 'Mano que señala hacia la izquierda.'
        ]);

        Emoticon::create([
            'code' => urlencode('👉🏼'),
            'description' => 'Mano que señala hacia la derecha.'
        ]);

        Emoticon::create([
            'code' => urlencode('👆🏼'),
            'description' => 'Mano que señala hacia arriba.'
        ]);

        Emoticon::create([
            'code' => urlencode('👇🏼'),
            'description' => 'Mano que señala hacia abajo.'
        ]);

        Emoticon::create([
            'code' => urlencode('✋🏼'),
            'description' => 'Palma de la mano.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤚🏼'),
            'description' => 'Dorso de la mano.'
        ]);

        Emoticon::create([
            'code' => urlencode('🖐🏼'),
            'description' => 'Mano abierta.'
        ]);

        Emoticon::create([
            'code' => urlencode('🖖🏼'),
            'description' => 'Saludo vulcano.'
        ]);

        Emoticon::create([
            'code' => urlencode('👋🏼'),
            'description' => 'Mano que saluda.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤙🏼'),
            'description' => 'Mano que hace el gesto de llamar.'
        ]);

        Emoticon::create([
            'code' => urlencode('💪🏼'),
            'description' => 'Bíceps flexionado.'
        ]);

        Emoticon::create([
            'code' => urlencode('🦾'),
            'description' => 'Bíceps biónico flexionado.'
        ]);

        Emoticon::create([
            'code' => urlencode('✍🏼'),
            'description' => 'Mano que escribe.'
        ]);

        Emoticon::create([
            'code' => urlencode('🙏🏼'),
            'description' => 'Manos en oración.'
        ]);

        Emoticon::create([
            'code' => urlencode('🦶🏼'),
            'description' => 'Pie.'
        ]);

        Emoticon::create([
            'code' => urlencode('🦵🏼'),
            'description' => 'Pierna.'
        ]);

        Emoticon::create([
            'code' => urlencode('🦿'),
            'description' => 'Pierna biónica.'
        ]);

        Emoticon::create([
            'code' => urlencode('❤️'),
            'description' => 'Amor.'
        ]);

        Emoticon::create([
            'code' => urlencode('🧡'),
            'description' => 'Amor de amigos.'
        ]);

        Emoticon::create([
            'code' => urlencode('💛'),
            'description' => 'Amor puro y sincero.'
        ]);

        Emoticon::create([
            'code' => urlencode('💚'),
            'description' => 'Amor a la naturaleza.'
        ]);

        Emoticon::create([
            'code' => urlencode('💙'),
            'description' => 'Amor con seguridad y confianza.'
        ]);

        Emoticon::create([
            'code' => urlencode('💜'),
            'description' => 'Amor prohibido u oculto.'
        ]);

        Emoticon::create([
            'code' => urlencode('🖤'),
            'description' => 'Símbolo del humor negro.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤍'),
            'description' => 'Amor hacia una persona fallecida.'
        ]);

        Emoticon::create([
            'code' => urlencode('🤎'),
            'description' => 'Utilizado para discutir temas relacionados con la identidad racial.'
        ]);

        Emoticon::create([
            'code' => urlencode('💔'),
            'description' => 'Corazón roto.'
        ]);

        Emoticon::create([
            'code' => urlencode('💕'),
            'description' => 'El mor está en el aire.'
        ]);

        Emoticon::create([
            'code' => urlencode('💞'),
            'description' => 'Representa el amor entre dos personas.'
        ]);

        Emoticon::create([
            'code' => urlencode('💓'),
            'description' => 'Corazón latiendo.'
        ]);

        Emoticon::create([
            'code' => urlencode('💗'),
            'description' => 'El amor está en crecimiento.'
        ]);

        Emoticon::create([
            'code' => urlencode('💖'),
            'description' => 'Corazón con estrellas.'
        ]);

        Emoticon::create([
            'code' => urlencode('💘'),
            'description' => 'Corazón flechado de cupido.'
        ]);

        Emoticon::create([
            'code' => urlencode('🚚'),
            'description' => 'Camión De Reparto.'
        ]);

        Emoticon::create([
            'code' => urlencode('🚀 '),
            'description' => 'Cohete'
        ]);

        Emoticon::create([
            'code' => urlencode('✅'),
            'description' => 'Botón De Marca De Verificación.'
        ]);

        Emoticon::create([
            'code' => urlencode('💯'),
            'description' => 'Cien Puntos.'
        ]);

        Emoticon::create([
            'code' => urlencode('🎉'),
            'description' => 'Cañón De Confeti.'
        ]);

        Emoticon::create([
            'code' => urlencode('🛵'),
            'description' => 'Moto Scooter.'
        ]);

    }
}
