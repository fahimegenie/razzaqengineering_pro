<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if aboutus table already exists
        if (!Schema::hasTable('aboutus')) {
            // Create new table with all fields
            Schema::create('aboutus', function (Blueprint $table) {
                $table->id();
                $table->string('about_title');
                $table->text('about_description_1');
                $table->text('about_description_2');
                $table->string('a_image')->nullable();
                $table->string('mission_title')->nullable();
                $table->text('mission_description')->nullable();
                $table->string('vision_title')->nullable();
                $table->text('vision_description')->nullable();
                $table->string('values_title')->nullable();
                $table->text('values_description')->nullable();
                $table->integer('years_experience')->default(0);
                $table->integer('projects_completed')->default(0);
                $table->integer('happy_clients')->default(0);
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                
                // Additional useful fields
                $table->string('about_subtitle')->nullable();
                $table->text('about_short_description')->nullable();
                $table->string('about_banner')->nullable();
                $table->string('about_video_url')->nullable();
                $table->json('about_gallery')->nullable();
                $table->json('certifications')->nullable();
                $table->json('awards')->nullable();
                $table->text('our_story')->nullable();
                $table->text('why_choose_us')->nullable();
                $table->json('key_points')->nullable();
                $table->json('statistics')->nullable();
                $table->string('ceo_name')->nullable();
                $table->string('ceo_image')->nullable();
                $table->text('ceo_message')->nullable();
                $table->string('ceo_designation')->nullable();
                $table->boolean('is_active')->default(true);
                $table->string('meta_robots')->default('index, follow')->nullable();
                $table->string('og_image')->nullable();
                $table->string('canonical_url')->nullable();
                $table->text('schema_markup')->nullable();
                $table->timestamps();
            });
            
            // Insert default record
            DB::table('aboutus')->insert([
                'about_title' => 'About Razzaq Engineering',
                'about_description_1' => 'We are a leading engineering company specializing in concrete cutting services.',
                'about_description_2' => 'With years of experience, we deliver quality services across Pakistan.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            Log::info('Created aboutus table with all fields');
            
        } else {
            // Table exists - check and add missing columns
            Log::info('aboutus table already exists, checking for missing columns...');
            $this->addMissingColumns();
        }
    }

    /**
     * Add missing columns to existing aboutus table
     */
    private function addMissingColumns(): void
    {
        // Get existing columns
        $existingColumns = $this->getExistingColumns();
        
        // Define all columns with their specifications
        $columns = [
            // Core fields (check if exist)
            'about_title' => ['type' => 'string', 'nullable' => false, 'after' => 'id'],
            'about_description_1' => ['type' => 'text', 'nullable' => false, 'after' => 'about_title'],
            'about_description_2' => ['type' => 'text', 'nullable' => false, 'after' => 'about_description_1'],
            'a_image' => ['type' => 'string', 'nullable' => true, 'after' => 'about_description_2'],
            
            // Mission/Vision/Values
            'mission_title' => ['type' => 'string', 'nullable' => true, 'after' => 'a_image'],
            'mission_description' => ['type' => 'text', 'nullable' => true, 'after' => 'mission_title'],
            'vision_title' => ['type' => 'string', 'nullable' => true, 'after' => 'mission_description'],
            'vision_description' => ['type' => 'text', 'nullable' => true, 'after' => 'vision_title'],
            'values_title' => ['type' => 'string', 'nullable' => true, 'after' => 'vision_description'],
            'values_description' => ['type' => 'text', 'nullable' => true, 'after' => 'values_title'],
            
            // Statistics
            'years_experience' => ['type' => 'integer', 'nullable' => false, 'default' => 0, 'after' => 'values_description'],
            'projects_completed' => ['type' => 'integer', 'nullable' => false, 'default' => 0, 'after' => 'years_experience'],
            'happy_clients' => ['type' => 'integer', 'nullable' => false, 'default' => 0, 'after' => 'projects_completed'],
            
            // SEO fields
            'meta_title' => ['type' => 'string', 'nullable' => true, 'after' => 'happy_clients'],
            'meta_description' => ['type' => 'text', 'nullable' => true, 'after' => 'meta_title'],
            'meta_keywords' => ['type' => 'string', 'nullable' => true, 'after' => 'meta_description'],
            
            // Additional fields
            'about_subtitle' => ['type' => 'string', 'nullable' => true, 'after' => 'meta_keywords'],
            'about_short_description' => ['type' => 'text', 'nullable' => true, 'after' => 'about_subtitle'],
            'about_banner' => ['type' => 'string', 'nullable' => true, 'after' => 'about_short_description'],
            'about_video_url' => ['type' => 'string', 'nullable' => true, 'after' => 'about_banner'],
            'about_gallery' => ['type' => 'text', 'nullable' => true, 'after' => 'about_video_url'],
            'certifications' => ['type' => 'text', 'nullable' => true, 'after' => 'about_gallery'],
            'awards' => ['type' => 'text', 'nullable' => true, 'after' => 'certifications'],
            'our_story' => ['type' => 'text', 'nullable' => true, 'after' => 'awards'],
            'why_choose_us' => ['type' => 'text', 'nullable' => true, 'after' => 'our_story'],
            'key_points' => ['type' => 'text', 'nullable' => true, 'after' => 'why_choose_us'],
            'statistics' => ['type' => 'text', 'nullable' => true, 'after' => 'key_points'],
            
            // CEO Info
            'ceo_name' => ['type' => 'string', 'nullable' => true, 'after' => 'statistics'],
            'ceo_image' => ['type' => 'string', 'nullable' => true, 'after' => 'ceo_name'],
            'ceo_message' => ['type' => 'text', 'nullable' => true, 'after' => 'ceo_image'],
            'ceo_designation' => ['type' => 'string', 'nullable' => true, 'after' => 'ceo_message'],
            
            // Status & Advanced SEO
            'is_active' => ['type' => 'boolean', 'nullable' => false, 'default' => true, 'after' => 'ceo_designation'],
            'meta_robots' => ['type' => 'string', 'nullable' => true, 'default' => 'index, follow', 'after' => 'is_active'],
            'og_image' => ['type' => 'string', 'nullable' => true, 'after' => 'meta_robots'],
            'canonical_url' => ['type' => 'string', 'nullable' => true, 'after' => 'og_image'],
            'schema_markup' => ['type' => 'text', 'nullable' => true, 'after' => 'canonical_url'],
        ];
        
        // Check and add each missing column
        foreach ($columns as $column => $definition) {
            if (!in_array($column, $existingColumns)) {
                $this->addColumn($column, $definition);
            } else {
                Log::info("Column '{$column}' already exists in aboutus table, skipping...");
            }
        }
        
        // Check if timestamps exist
        if (!in_array('created_at', $existingColumns)) {
            $this->addTimestamps();
        }
    }

    /**
     * Get existing columns from aboutus table
     */
    private function getExistingColumns(): array
    {
        try {
            return Schema::getColumnListing('aboutus');
        } catch (\Exception $e) {
            Log::error('Failed to get columns from aboutus table: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Add a single column safely
     */
    private function addColumn(string $column, array $definition): void
    {
        try {
            $type = $definition['type'];
            $nullable = $definition['nullable'] ?? true;
            $default = $definition['default'] ?? null;
            
            // Build SQL based on type
            $sql = "ALTER TABLE `aboutus` ADD `{$column}` ";
            
            switch ($type) {
                case 'string':
                    $sql .= "VARCHAR(255)";
                    break;
                case 'text':
                    $sql .= "TEXT";
                    break;
                case 'integer':
                    $sql .= "INT";
                    break;
                case 'boolean':
                    $sql .= "TINYINT(1)";
                    break;
                default:
                    $sql .= "VARCHAR(255)";
            }
            
            // Add nullable
            if ($nullable) {
                $sql .= " NULL";
            } else {
                $sql .= " NOT NULL";
            }
            
            // Add default value
            if ($default !== null) {
                if (is_string($default)) {
                    $sql .= " DEFAULT '{$default}'";
                } elseif (is_bool($default)) {
                    $sql .= " DEFAULT " . ($default ? '1' : '0');
                } else {
                    $sql .= " DEFAULT {$default}";
                }
            }
            
            // Execute SQL
            DB::statement($sql);
            Log::info("Added column '{$column}' to aboutus table");
            
        } catch (\Exception $e) {
            Log::warning("Failed to add column '{$column}' to aboutus table: " . $e->getMessage());
            
            // Try alternative method using Schema builder
            try {
                Schema::table('aboutus', function (Blueprint $table) use ($column, $definition) {
                    $type = $definition['type'];
                    $col = null;
                    
                    switch ($type) {
                        case 'string':
                            $col = $table->string($column, 255);
                            break;
                        case 'text':
                            $col = $table->text($column);
                            break;
                        case 'integer':
                            $col = $table->integer($column);
                            break;
                        case 'boolean':
                            $col = $table->boolean($column);
                            break;
                        default:
                            $col = $table->string($column, 255);
                    }
                    
                    if ($definition['nullable'] ?? true) {
                        $col->nullable();
                    }
                    
                    if (isset($definition['default'])) {
                        $col->default($definition['default']);
                    }
                });
                
                Log::info("Added column '{$column}' to aboutus table (Schema builder)");
                
            } catch (\Exception $e2) {
                Log::error("Failed to add column '{$column}' using both methods: " . $e2->getMessage());
            }
        }
    }

    /**
     * Add timestamps if they don't exist
     */
    private function addTimestamps(): void
    {
        try {
            DB::statement("ALTER TABLE `aboutus` ADD `created_at` TIMESTAMP NULL DEFAULT NULL");
            DB::statement("ALTER TABLE `aboutus` ADD `updated_at` TIMESTAMP NULL DEFAULT NULL");
            Log::info('Added timestamps to aboutus table');
        } catch (\Exception $e) {
            Log::warning('Failed to add timestamps to aboutus table: ' . $e->getMessage());
            
            // Try Schema builder
            try {
                Schema::table('aboutus', function (Blueprint $table) {
                    $table->timestamps();
                });
            } catch (\Exception $e2) {
                Log::error('Failed to add timestamps using both methods: ' . $e2->getMessage());
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't drop the table completely to preserve data
        // Only remove additional columns that were added by this migration
        if (Schema::hasTable('aboutus')) {
            $additionalColumns = [
                'about_subtitle',
                'about_short_description',
                'about_banner',
                'about_video_url',
                'about_gallery',
                'certifications',
                'awards',
                'our_story',
                'why_choose_us',
                'key_points',
                'statistics',
                'ceo_name',
                'ceo_image',
                'ceo_message',
                'ceo_designation',
                'is_active',
                'meta_robots',
                'og_image',
                'canonical_url',
                'schema_markup',
            ];
            
            Schema::table('aboutus', function (Blueprint $table) use ($additionalColumns) {
                foreach ($additionalColumns as $column) {
                    if (Schema::hasColumn('aboutus', $column)) {
                        $table->dropColumn($column);
                        Log::info("Dropped column '{$column}' from aboutus table");
                    }
                }
            });
        }
    }
};