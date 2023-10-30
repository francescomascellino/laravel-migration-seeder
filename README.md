<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Migration/Seeder

php artisan make:migration create_trains_table

CREATES A NEW MIGRATION FOR A NEW TABLE CALLED 'trains' ON THE DATABASE

 Migration [C:\MAMP\htdocs\Laravel\laravel-migration-seeder\database\migrations/2023_10_30_130439_create_trains_table.php] created successfully.

 ADD THE TABLE COLUMS IN THE up() FUNCTION Schema FACADE:

     public function up(): void
    {
        Schema::create('trains', function (Blueprint $table) {

            $table->id();

            $table->string('company', 20)->nullable();
            $table->string('departure_station');
            $table->dateTime('departure_time');
            $table->string('arrival_station');
            $table->dateTime('arrival_time');
            $table->tinyInteger('train_code')->unsigned();
            $table->tinyInteger('carriages')->nullable()->unsigned();
            $table->boolean('delay')->default(0);
            $table->boolean('canceled')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trains');
    }

EXECUTE THE MIGRATION

php artisan migrate

CHECK THE DATABASES

SHOW DATABASES;

+--------------------------+
| Database                 |
+--------------------------+
| information_schema       |
| db-university            |
| db-workshop              |
| laravel_migration_seeder |
| laravel_model_controller |
| mysql                    |
| performance_schema       |
| sys                      |
+--------------------------+
8 rows in set (0.00 sec)

ENTER THE DATABASE

USE laravel_migration_seeder; 

SHOW TABLES;
+------------------------------------+
| Tables_in_laravel_migration_seeder |
+------------------------------------+
| failed_jobs                        |
| migrations                         |
| password_reset_tokens              |
| personal_access_tokens             |
| trains                             |
| users                              |
+------------------------------------+
6 rows in set (0.00 sec)

CHECK THE TABLE

DESCRIBE trains;
+-------------------+---------------------+------+-----+---------+----------------+
| Field             | Type                | Null | Key | Default | Extra          |
+-------------------+---------------------+------+-----+---------+----------------+
| id                | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| company           | varchar(20)         | YES  |     | NULL    |                |
| departure_station | varchar(255)        | NO   |     | NULL    |                |
| departure_time    | datetime            | NO   |     | NULL    |                |
| arrival_station   | varchar(255)        | NO   |     | NULL    |                |
| arrival_time      | datetime            | NO   |     | NULL    |                |
| train_code        | tinyint(3) unsigned | NO   |     | NULL    |                |
| carriages         | tinyint(3) unsigned | YES  |     | NULL    |                |
| delay             | tinyint(1)          | NO   |     | 0       |                |
| canceled          | tinyint(1)          | NO   |     | 0       |                |
| created_at        | timestamp           | YES  |     | NULL    |                |
| updated_at        | timestamp           | YES  |     | NULL    |                |
+-------------------+---------------------+------+-----+---------+----------------+
12 rows in set (0.00 sec)

CREATE THE MODEL CLASS "Train"

php artisan make:model Train

CREATE THE SEEDER FOR THE "trains" TABLE IN THE DATABASE

php artisan make:seeder TrainsTableSeeder

Seeder [C:\MAMP\htdocs\Laravel\laravel-migration-seeder\database/seeders/TrainsTableSeeder.php] created successfully.

ADD THE MODEL Train AND THE Faker api INTO THE SEEDER

use Faker\Generator as Faker;

use App\Models\Train;

ADD Faker AS A VARIABLE CALLED FAKER TO THE SEEDER RUN FUNCTION

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // USES FAKER
    public function run(Faker $faker): void
    {
        //
    }
}

PLANT THE SEED
php artisan db:seed --class=TrainsTableSeder

UPDATE THE TABLE

php artisan make:migration update_trains_table_ --table=trains

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->string('company')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->dropColumn('company');
        });
    }
};
