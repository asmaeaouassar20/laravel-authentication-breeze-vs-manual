<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestap('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_photo_path')->nulable();
            $table->string('role')->default('user');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->rememberToken(); // ajoute une colonne remember_token pour la fonctionnalité "Se souvenir de moi".
            $table->timestamps(); // ajoute created_at et updated_at.
            $table->softDeletes(); // ajoute deleted_at pour les suppressions logiques (sans supprimer la ligne de la base).
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
