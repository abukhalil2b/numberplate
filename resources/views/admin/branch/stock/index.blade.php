<x-layout.default>

    <style>
        .plate-box {
            border: 1px solid #999;
            border-radius: 5px;
            padding: 5px;
            box-shadow: 0px 1px 3px #999;
        }

        .bg-private {
            background-color: #fde047;
            color: black;
        }

        .bg-commercial {
            background-color: #fca5a5;
            color: white;
        }

        .bg-diplomatic {
            background-color: white;
            color: black;
        }

        .bg-temporary {
            background-color: lightgreen;
            color: white;
        }

        .bg-export {
            background-color: skyblue;
            color: white;
        }

        .bg-specific {
            background-color: black;
            color: white;
        }

        .bg-learners {
            background-color: white;
            color: red;
        }

        .bg-government {
            background-color: white;
            color: red;
        }

        .bg-other {
            background-color: white;
            color: black;
        }
    </style>

    <div class="p-3 text-center text-xl">
        Stock: {{ $branch->name }}
    </div>

    <div class="grid grid-cols-1 gap-6 pt-5 md:grid-cols-2 lg:grid-cols-4">

        <!-- private -->
        <div class="plate-box bg-private">
            <div class="text-xl">
                <h2 class="text-center">private</h2>
            </div>
            <div class="">
                @foreach($privates as $private)
                <div class="p-1 flex justify-between">
                    <div>{{ $private->size }}</div>
                    <div class="badge bg-dark w-16">{{ $private->total }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- commercial -->
        <div class="plate-box bg-commercial">
            <div class="text-xl">
                <h2 class="text-center">commercial</h2>
            </div>
            <div class="">
                @foreach($commercials as $commercial)
                <div class="p-1 flex justify-between">
                    <div>{{ $commercial->size }}</div>
                    <div class="badge bg-dark w-16">{{ $commercial->total }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- diplomatic -->
        <div class="plate-box bg-diplomatic">
            <div class="text-xl">
                <h2 class="text-center">diplomatic</h2>
            </div>
            <div class="">
                @foreach($diplomatics as $diplomatic)
                <div class="p-1 flex justify-between">
                    <div>{{ $diplomatic->size }}</div>
                    <div class="badge bg-dark w-16">{{ $diplomatic->total }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- temporary -->
        <div class="plate-box bg-temporary">
            <div class="text-xl">
                <h2 class="text-center">temporary</h2>
            </div>
            <div class="">
                @foreach($temporarys as $temporary)
                <div class="p-1 flex justify-between">
                    <div>{{ $temporary->size }}</div>
                    <div class="badge bg-dark w-16">{{ $temporary->total }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- export -->
        <div class="plate-box bg-export">
            <div class="text-xl">
                <h2 class="text-center">export</h2>
            </div>
            <div class="">
                @foreach($exports as $export)
                <div class="p-1 flex justify-between">
                    <div>{{ $export->size }}</div>
                    <div class="badge bg-dark w-16">{{ $export->total }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- specific -->
        <div class="plate-box bg-specific">
            <div class="text-xl">
                <h2 class="text-center">specific</h2>
            </div>
            <div class="">
                @foreach($specifics as $specific)
                <div class="p-1 flex justify-between">
                    <div>{{ $specific->size }}</div>
                    <div class="badge bg-dark w-16">{{ $specific->total }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- learners -->
        <div class="plate-box bg-learners">
            <div class="text-xl">
                <h2 class="text-center">learners</h2>
            </div>
            <div class="">
                @foreach($learners as $learner)
                <div class="p-1 flex justify-between">
                    <div>{{ $learner->size }}</div>
                    <div class="badge bg-dark w-16">{{ $learner->total }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- government -->
        <div class="plate-box bg-government">
            <div class="text-xl">
                <h2 class="text-center">government</h2>
            </div>
            <div class="">
                @foreach($governments as $government)
                <div class="p-1 flex justify-between">
                    <div>{{ $government->size }}</div>
                    <div class="badge bg-dark w-16">{{ $government->total }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- other -->
        <div class="plate-box bg-other">
            <div class="text-xl">
                <h2 class="text-center">other</h2>
            </div>
            <div class="">
                @foreach($commercials as $commercial)
                <div class="p-1 flex justify-between">
                    <div>{{ $commercial->size }}</div>
                    <div class="badge bg-dark w-16">{{ $commercial->total }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</x-layout.default>