<?php
include "main/session.php";
$id = $_GET['hakuna'];
$docs = $obj->selectextrawhere("userdocuments", "status = 1 and userid =" . $id . ""); ?>
<div class="w-full overflow-hidden rounded-lg shadow-xs">

    <div class="w-full ">

        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-3 py-2">Document Name</th>
                    <th class="px-3 py-2">Image</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php while ($data = $obj->fetch_assoc($docs)) { ?>
                    <tr class="text-gray-700 dark:text-gray-400">

                        <td class=" px-3 py-2 text-sm">
                            <?= $data['name'] ?>
                        </td>
                        <td class=" px-3 py-2 text-sm">
                            <a target="_blank" href="../main/<?= $obj->fetchattachment($data['path']) ?>"><img src="../main/<?= $obj->fetchattachment($data['path']) ?>" /></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $("#modalfooterbtn").css('display', 'none')
</script>