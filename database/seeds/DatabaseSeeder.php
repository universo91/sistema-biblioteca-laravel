<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->truncateTablas([
            'rol',
            'permiso',
            'libro',
            'usuario',
            'usuario_rol'
        ]);

       
        $this->call(TablaPermisoSeeder::class);
        $this->call(TablaLibroSeeder::class);
        $this->call(UsuarioAdministradorSeeder::class); $this->call(TablaRolSeeder::class);
    }

    protected function truncateTablas(array $tablas) {
        // SETEO DE FOREIGN KEYS EN CERO, desabilitar el chequeo o verificacion
        // de llaves foraneas, para que me deje truncar la tabla especifica
        // esto no se hace en produccion, podria eliminar toda la info y se pueden crear
        // un error de indices foraneas

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach( $tablas as $tabla ) {
            // nota: La sentencia "truncate table" en mysql vacía la tabla (elimina todos los
            // registros) y vuelve a crear la tabla con la misma estructura.
            // Elimina todas las filas de una tabla. Es una instrucción DDL; internamente
            // truncate: hace un DROP de la tabla y después hace un CREATE de la misma
            // tabla.
            DB::table($tabla)->truncate();
        }
        // habilitando las llaves foraneas en la BD
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
