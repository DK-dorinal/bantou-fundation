<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter les colonnes qui n'existent pas déjà
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['donateur', 'adherent', 'partenaire', 'benevole', 'admin'])
                      ->default('benevole');
            }

            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }

            if (!Schema::hasColumn('users', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable();
            }

            if (!Schema::hasColumn('users', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable();
            }

            if (!Schema::hasColumn('users', 'birth_date')) {
                $table->date('birth_date')->nullable();
            }

            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['homme', 'femme'])->nullable();
            }

            if (!Schema::hasColumn('users', 'profession')) {
                $table->string('profession')->nullable();
            }

            if (!Schema::hasColumn('users', 'motivation')) {
                $table->text('motivation')->nullable();
            }

            if (!Schema::hasColumn('users', 'expertise_areas')) {
                $table->json('expertise_areas')->nullable();
            }

            if (!Schema::hasColumn('users', 'membership_type')) {
                $table->string('membership_type')->nullable();
            }

            if (!Schema::hasColumn('users', 'id_document')) {
                $table->string('id_document')->nullable();
            }

            if (!Schema::hasColumn('users', 'is_anonymous')) {
                $table->boolean('is_anonymous')->default(false);
            }

            if (!Schema::hasColumn('users', 'donation_total')) {
                $table->decimal('donation_total', 12, 2)->default(0);
            }

            if (!Schema::hasColumn('users', 'organization_name')) {
                $table->string('organization_name')->nullable();
            }

            if (!Schema::hasColumn('users', 'sector')) {
                $table->string('sector')->nullable();
            }

            if (!Schema::hasColumn('users', 'contact_name')) {
                $table->string('contact_name')->nullable();
            }

            if (!Schema::hasColumn('users', 'position')) {
                $table->string('position')->nullable();
            }

            if (!Schema::hasColumn('users', 'city_country')) {
                $table->string('city_country')->nullable();
            }

            if (!Schema::hasColumn('users', 'partnership_type')) {
                $table->string('partnership_type')->nullable();
            }

            if (!Schema::hasColumn('users', 'message')) {
                $table->text('message')->nullable();
            }

            if (!Schema::hasColumn('users', 'attachment')) {
                $table->string('attachment')->nullable();
            }

            if (!Schema::hasColumn('users', 'interests')) {
                $table->json('interests')->nullable();
            }

            if (!Schema::hasColumn('users', 'skills')) {
                $table->json('skills')->nullable();
            }

            if (!Schema::hasColumn('users', 'experience')) {
                $table->text('experience')->nullable();
            }

            if (!Schema::hasColumn('users', 'languages')) {
                $table->string('languages')->nullable();
            }

            if (!Schema::hasColumn('users', 'availability')) {
                $table->string('availability')->nullable();
            }

            if (!Schema::hasColumn('users', 'engagement')) {
                $table->string('engagement')->nullable();
            }

            if (!Schema::hasColumn('users', 'duration')) {
                $table->string('duration')->nullable();
            }

            if (!Schema::hasColumn('users', 'expectations')) {
                $table->text('expectations')->nullable();
            }

            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées
            $columns = [
                'role', 'phone', 'address', 'latitude', 'longitude', 'birth_date',
                'gender', 'profession', 'motivation', 'expertise_areas', 'membership_type',
                'id_document', 'is_anonymous', 'donation_total', 'organization_name',
                'sector', 'contact_name', 'position', 'city_country', 'partnership_type',
                'message', 'attachment', 'interests', 'skills', 'experience', 'languages',
                'availability', 'engagement', 'duration', 'expectations', 'is_active'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
