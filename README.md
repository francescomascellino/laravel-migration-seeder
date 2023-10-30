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

            $table->string('company', 20);
            $table->string('departure_station');
            $table->string('departure_time', 5);
            $table->string('arrival_station');
            $table->string('arrival_time', 5);
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
};
