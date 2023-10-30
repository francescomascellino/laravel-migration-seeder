<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Migration/Seeder

## CREATE A NEW MIGRATION FOR A NEW TABLE CALLED 'trains' ON THE DATABASE

```

php artisan make:migration create_trains_table

```

RESULT:

```

Migration [C:\MAMP\htdocs\Laravel\laravel-migration-seeder\database\migrations/2023_10_30_130439_create_trains_table.php] created successfully.

```

## ADD THE TABLE COLUMS IN THE up() FUNCTION Schema FACADE:

```php

     public function up(): void
    {
        Schema::create('trains', function (Blueprint $table) {

            $table->id(); //ALREADY PRESET BY LARAVEL

            $table->string('company', 20)->nullable();
            $table->string('departure_station');
            $table->dateTime('departure_time');
            $table->string('arrival_station');
            $table->dateTime('arrival_time');
            $table->tinyInteger('train_code')->unsigned();
            $table->tinyInteger('carriages')->nullable()->unsigned();
            $table->boolean('delay')->default(0);
            $table->boolean('canceled')->default(0);

            $table->timestamps(); //ALREADY PRESET BY LARAVEL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trains');
    }

```

## EXECUTE THE MIGRATION

```

php artisan migrate

```

## CHECK THE DATABASES

```

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

```

ENTER THE DATABASE

```

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

```

CHECK THE TABLE

```

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

```

## CREATE THE SEEDER FOR THE "trains" TABLE IN THE DATABASE

```

php artisan make:seeder TrainsTableSeeder

```

RESULT:

```

Seeder [C:\MAMP\htdocs\Laravel\laravel-migration-seeder\database/seeders/TrainsTableSeeder.php] created successfully.

```

## CREATE THE MODEL CLASS "Train"

```

php artisan make:model Train

```

## ADD THE MODEL Train AND THE Faker api INTO THE SEEDER

```php

use Faker\Generator as Faker;

use App\Models\Train;

```

ADD Faker AS A VARIABLE CALLED FAKER TO THE SEEDER RUN FUNCTION AND POPULATE THE SEED

```php

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // USES FAKER
    public function run(Faker $faker): void
    {
        //USES A FOR LOOP TO ADD 10 ENTRIES ON THE TABLE
        for ($i = 0; $i < 10; $i++) {
            $train = new Train();
            $train->company = $faker->company();
            $train->departure_station = $faker->city();
            $train->departure_time = $faker->dateTimeThisMonth('+10 days');
            $train->arrival_station = $faker->city();
            $train->arrival_time = $train->departure_time->modify('+2 days')->format('Y-m-d H:i:s');
            $train->train_code = $faker->numberBetween(0, 200);
            $train->carriages = $faker->randomDigitNotNull();
            $train->delay = $faker->boolean();
            $train->canceled = $faker->boolean();

            //SAVE THE DATA
            $train->save();
        }
    }
}

```

## PLANT THE SEED

```

php artisan db:seed --class=TrainsTableSeder

```

## IF IT IS NEEDED TO UPDATE THE TABLE:

```

php artisan make:migration update_trains_table --table=trains

```

EDIT THE TABLE IN THE UP AND DOWN FUNCTIONS IN THE update_trains_table.php MIGRATION FILE (REMOVES THE STRING LIMIT 50 FROM THE company COLUMN)

```php

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->string('company')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // REVERTS THE company COLUMN TO THE ORIGINAL VALUE
        Schema::table('trains', function (Blueprint $table) {
            $table->string('company', 50)-change();
        });
    }
};

```

## ADD A PAGE CONTROLLER

```

php artisan make:controller Guests/PageController

```

## DEFINE THE ROUTE IN App\Http\Controllers\Guests\PageController.php

```php

    public function home()
    {
        // RETURNS THE VIEW 'home' (home.blade.php)
        return view('home');
    }

```

## EDIT THE 'home' METHOD AND GIVE THE MODEL Train AS A COLLECTION ARRAY

ADD

```php

use App\Models\Train;

```

EDIT


```php

public function home()
{
    return view('home', ['trains' => Train::all()]);
}

```

## UPDATE THE ROUTE IN web.php

ADD THE PageController TO USE ITS METHODS

```php

use App\Http\Controllers\Guests\PageController;


```

GETS THE ROUTE FROM THE Controller PageController CLASS AND USES THE 'home' METHOD. GIVES THE ROUTE THE "home" NAME:

```php

Route::get('/', [PageController::class, 'home'])->name('home');

```

## EXTRA: ORDER THE TRAINS BY A VALUE USING sortBy()

EDIT PageController (App\Http\Controllers\Guests\PageController.php):

```php

    public function home()
    {
        $trains = Train::all();

        // SORTS A COLLECTION USING A CALLBACK VALUE
        // https://laravel.com/docs/5.1/collections#method-sortby 
        $sorted_trains = $trains->sortBy('departure_time')->values()->all();

        //compact() CREATES AN ARRAY FROM THE $sorted_trains COLLECTION
        return view('home', compact('sorted_trains'));
    }

```

## EXTRA DROP ALL AND START AGAIN WITH AUTO SEEDING

LINK THE SEEDER IN seeders/DatabaseSeeder.php

```

use App\Database\Seeders\TrainsTableSeeder;

```

ADD IN seeders/DatabaseSeeder run METHOD:

```php

    public function run(): void
    {
        $this->call([
            TrainsTableSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

```

USE (https://laravel-news.com/migrate-fresh)

```

php artisan migrate:fresh --seed

```