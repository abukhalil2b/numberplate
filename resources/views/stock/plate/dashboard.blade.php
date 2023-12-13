<x-app-layout>

    <div class="mt-1 p-2">
        <div class="p-1 rounded border m-1">
            {{ $loggedUser->name }}
        </div>
    </div>

    <div class="px-3 py-1">
        <!-- private -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center private_plate_selected" colspan="3">private</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

        <!-- commercial -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center commercial_plate_selected" colspan="3">commercial</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

        <!-- diplomatic -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center diplomatic_plate_selected" colspan="3">diplomatic</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

        <!-- temporary -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center temporary_plate_selected" colspan="3">temporary</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

        <!-- export -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center export_plate_selected" colspan="3">export</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

        <!-- specific -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center specific_plate_selected" colspan="3">specific</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

        <!-- learners -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center learners_plate_selected" colspan="3">learners</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

        <!-- government -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center government_plate_selected" colspan="3">government</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

        <!-- other -->
        <table class="mt-1">
            <thead>
                <tr class="border">
                    <td class="p-2 text-center other_plate_selected" colspan="3">other</td>
                </tr>
                <tr class="border">
                    <td class="p-2 border">small</td>
                    <td class="p-2 border">meduim</td>
                    <td class="p-2 border">large</td>
                </tr>
            </thead>
            <tbody>
                <tr class="border">
                    <td class="p-2 border">100</td>
                    <td class="p-2 border">300</td>
                    <td class="p-2 border">20</td>
                </tr>
            </tbody>
        </table>

    </div>

</x-app-layout>