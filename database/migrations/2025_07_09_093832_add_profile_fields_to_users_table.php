<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->date('birthdate')->nullable()->after('address');
            $table->enum('gender', ['Masculino', 'Feminino', 'Outro'])->nullable()->after('birthdate');
            $table->string('level')->nullable()->after('gender'); // Classe ou nível
            $table->string('previous_group')->nullable()->after('level'); // Grupo anterior
            $table->string('father_name')->nullable()->after('previous_group');
            $table->string('mother_name')->nullable()->after('father_name');
            $table->enum('marital_status', ['Solteiro', 'Casado', 'Divorciado', 'Viúvo'])->nullable()->after('mother_name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address',
                'birthdate',
                'gender',
                'level',
                'previous_group',
                'father_name',
                'mother_name',
                'marital_status',
            ]);
        });
    }
};
