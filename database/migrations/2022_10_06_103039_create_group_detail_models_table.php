<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('groupdetails', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('userid')->unsigned();
                $table->bigInteger('groupid')->unsigned();
                $table->timestamps();
            });

            DB::table("groupdetails")->insert([
                "userid" => "1",
                "groupid" => "1",
            ]);
            for($i = 1; $i <= 8; $i++) {
                DB::table("groupdetails")->insert([
                    "userid" => $i,
                    "groupid" => "2",
                ]);
            }

            //Ticket
            DB::table("groupdetails")->insert([
                "userid" => "3",
                "groupid" => "11",
            ]);

            //Inventar
            DB::table("groupdetails")->insert([
                "userid" => "4",
                "groupid" => "12",
            ]);

            //Faq
            DB::table("groupdetails")->insert([
                "userid" => "5",
                "groupid" => "13",
            ]);

            //CTA Lehrer
            DB::table("groupdetails")->insert([
                "userid" => "6",
                "groupid" => "3",
            ]);
            DB::table("groupdetails")->insert([
                "userid" => "6",
                "groupid" => "14",
            ]);

            //CTA Schüler
            DB::table("groupdetails")->insert([
                "userid" => "8",
                "groupid" => "3",
            ]);

        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('groupdetails');
        }
    };
