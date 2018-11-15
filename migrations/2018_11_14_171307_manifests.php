<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class Manifests extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('manifests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->unique();
            $table->string('manifest_name')->nullable();
            $table->string('catalogs')->nullable();
            $table->string('included_manifests')->nullable();
            $table->string('managed_installs')->nullable();
            $table->string('managed_uninstalls')->nullable();
            $table->string('optional_installs')->nullable();
            $table->string('managed_updates')->nullable();
            $table->string('featured_items')->nullable();
            $table->string('condition')->nullable();
            $table->string('conditional_items')->nullable();
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('manifests');
    }
}
