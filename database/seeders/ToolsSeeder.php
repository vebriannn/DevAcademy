<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tools;

class ToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tools = [
            [
                'name_tools' => 'Visual Studio Code',
                'link_tools' => 'https://code.visualstudio.com/download',
                'logo_tools' => 'vscode.png'
            ],
            [
                'name_tools' => 'Mysql',
                'link_tools' => 'https://www.mysql.com/downloads',
                'logo_tools' => 'mysql.png'
            ],
            [
                'name_tools' => 'Figma',
                'link_tools' => 'https://www.figma.com/downloads',
                'logo_tools' => 'figma.png'
            ]
        ];

        for ($i = 0; $i < count($Tools); $i++) {
            Tools::create($Tools[$i]);
        }
    }
}
