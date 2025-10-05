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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_contact')->nullable();
            $table->string('company_email');
            $table->string('company_role');
            $table->string('company_application_name')->nullable();
            $table->string('company_application_url')->nullable();
            $table->foreignId('template_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_id')->constrained()->nullOnDelete();
            $table->string('status');
            $table->timestamp('sent_at')->nullable();
            $table->string('letter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
