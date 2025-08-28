<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->enum('action', [
                'create_user',
                'update_user',
                'delete_user',
                'create_enrollment',
                'update_enrollment',
                'delete_enrollment',
                'add_grade',
                'update_grade',
                'delete_grade',
            ])->comment('Ação realizada pelo administrador');
            $table->text('description')->nullable(); // detalhes extras
            $table->ipAddress('ip_address')->nullable(); // IP do admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_logs');
    }
};
