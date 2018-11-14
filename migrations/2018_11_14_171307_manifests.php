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
            $table->string('manifest_catalogs')->nullable();
            $table->string('manifest_included_manifests')->nullable();
            $table->string('manifest_managed_installs')->nullable();
            $table->string('manifest_managed_uninstalls')->nullable();
            $table->string('manifest_optional_installs')->nullable();
            $table->string('manifest_managed_updates')->nullable();
            $table->string('manifest_featured_items')->nullable();
            $table->string('manifest_conditional_items')->nullable();
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('manifests');
    }
}
