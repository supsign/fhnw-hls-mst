<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TaxonomieSeeder extends Seeder
{
    private $taxonomieen = [
        ['id_taxonomie' => '1', 'beschreibung' => 'kennen', 'erklaerung' => 'Die Lernenden geben wieder, was sie vorher gelernt haben. Der Prüfungsstoff musste auswendig gelernt oder geübt werden.'],
        ['id_taxonomie' => '2', 'beschreibung' => 'verstehen', 'erklaerung' => 'Die Lernenden erklären einen Begriff, eine Formel, einen Sachverhalt oder ein Gerät. Sie haben das Gelernte auch in einem anderen als dem gelernten Kontext präsent. Sie können z.B. einen Sachverhalt umgangssprachlich erläutern oder graphisch darstellen.'],
        ['id_taxonomie' => '3', 'beschreibung' => 'anwenden', 'erklaerung' => 'Die Lernenden wenden etwas Gelerntes in einer neuen Situation an. Diese Anwendungssituation ist bisher nicht vorgekommen.'],
        ['id_taxonomie' => '4', 'beschreibung' => 'analysieren', 'erklaerung' => 'Die Lernenden zerlegen Modelle, Verfahren oder anderes in deren Bestandteile. Dabei müssen sie in komplexen Sachverhalten die Aufbauprinzipien oder inneren Strukturen entdecken. Sie erkennen Zusammenhänge.'],
        ['id_taxonomie' => '5', 'beschreibung' => 'beurteilen', 'erklaerung' => 'Die Lernenden beurteilen ein Modell, eine Lösung, einen Ansatz, ein Verfahren oder etwas Ähnliches insgesamt in Hinsicht auf dessen Zweckmässigkeit oder innere Struktur. Sie kennen z.B. das Modell, dessen Bestandteile und darüber hinaus noch die Qualitätsangemessenheit, die innere Stimmigkeit der Funktionstüchtigkeit. Darüber müssen sie sich ein Urteil bilden, um die Aufgabe richtig zu lösen.'],
        ['id_taxonomie' => '6', 'beschreibung' => 'erschaffen', 'erklaerung' => 'Die Lernenden zeigen eine konstruktive Leistung. Sie müssen verschiedene Teile zusammenfügen, die sie noch nicht zusammen erlebt oder gesehen haben. Aus ihrer Sicht müssen sie eine schöpferische Leistung erbringen. Das Neue ist aber in der bisherigen Erfahrung oder in der Kenntnis der Lernenden noch nicht vorhanden.'],
    ];

    public function run()
    {
        foreach ($this->taxonomieen as $taxonomie) {
            DB::table('hls.taxonomie')->updateOrInsert([
                'id_taxonomie' => $taxonomie['id_taxonomie'],
            ], [
                'beschreibung' => $taxonomie['beschreibung'],
                'erklaerung' => $taxonomie['erklaerung'],
            ]);
            DB::statement('ALTER SEQUENCE hls.taxonomie_id_taxonomie_seq RESTART with 7;');
        }
    }
}
