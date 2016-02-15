<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function(Blueprint $table){
            $table->increments('id');
            $table->integer('rel_owner_org_id')->unsigned();
            $table->foreign('rel_owner_org_id')->references('id')->on('organizations');
            $table->integer('rel_linked_org_id')->unsigned();
            $table->foreign('rel_linked_org_id')->references('id')->on('organizations');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types');
            $table->timestamps();

        });

        /*Schema::create('organization_relationship', function(Blueprint $table){
            $table->integer('organization_id')->unsigned()->index();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->integer('relationship_id')->unsigned()->index();
            $table->foreign('relationship_id')->references('id')->on('relationships')->onDelete('cascade');
            $table->timestamps();
        });*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('organization_relationship');
        Schema::dropIfExists('relationships');    
    }
}
