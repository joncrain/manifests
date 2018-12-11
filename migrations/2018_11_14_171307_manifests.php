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
            $table->string('serial_number');
            $table->string('manifest_name')->nullable();
            $table->text('catalogs')->nullable();
            $table->text('included_manifests')->nullable();
            $table->text('managed_installs')->nullable();
            $table->text('managed_uninstalls')->nullable();
            $table->text('optional_installs')->nullable();
            $table->text('managed_updates')->nullable();
            $table->text('featured_items')->nullable();
            $table->text('condition_check')->nullable();
            $table->text('conditional_items')->nullable();
            $table->string('display_name')->nullable();
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('manifests');
    }
}
