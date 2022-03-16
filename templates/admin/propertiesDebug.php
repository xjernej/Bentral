<div id="bentral_post_list" class="tabData" style="display: none;">
    <?php
    $propertiesIdList = $wpdb->get_results("SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = 'bentral_unit_id' GROUP BY meta_value", ARRAY_A);
    echo '<pre style="background: #0d2b3e; padding: 10px; color: #fffca8;">' . wp_unslash(json_encode($propertiesIdList, JSON_PRETTY_PRINT)) . '</pre>';
    ?>
</div>
<div id="property_list" class="tabData" style="display: none;">
    <table <?= $debugTableStyle; ?>>
        <thead>
        <tr>
            <th style="text-align: left;">#</th>
            <th style="text-align: left;">Code</th>
            <th style="text-align: left;">Property ID</th>
            <th style="text-align: left;">Property name</th>
            <th style="text-align: left;">Units</th>
            <th style="text-align: left;">Unit data</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sync = get_option('bentral_sync_properties');
        $x    = 1;
        if (!empty($sync)) {
            $bentral_sync_list = get_option('bentral_sync_list');
            foreach ($sync as $p) {
                $unitData  = (isset($bentral_sync_list[$p['id']])) ? $bentral_sync_list[$p['id']] : null;
                $unitCount = isset($unitData['units']) ? count($unitData['units']) : 0;
                echo '<tr>
                    <td style="' . $tdStyle . ' text-align: center; width: 30px; ">' . $x . '</td>
                    <td style="' . $tdStyle . ' text-align: center; width: 60px; ">' . $unitData['code'] . '</td>
                    <td style="' . $tdStyle . ' text-align: left; width: 150px"><span class="showSync" style="cursor: pointer;" data-id="' . $p['id'] . '">' . $p['id'] . '</span></td>
                    <td style="' . $tdStyle . ' text-align: left; width: 350px"><span class="showSync" style="cursor: pointer;" data-id="' . $p['id'] . '">' . $p['name'] . '</span></td>
                    <td style="' . $tdStyle . ' text-align: center; width: 30px; ">' . $unitCount . '</td>
                    <td style="' . $tdStyle . ' text-align: left;">
                        <pre style="background: #0d2b3e; padding: 10px; color: #fffca8;" class="hidden sync-' . $p['id'] . '">' . wp_unslash(json_encode($unitData, JSON_PRETTY_PRINT)) . '</pre>
                    </td>
                </tr>';
                $x++;
            }
        }
        ?>
        </tbody>
    </table>
</div>
<div id="property_data" class="tabData" style="display: none;">
    <table <?= $debugTableStyle; ?>>
        <tbody>
        <?php
        $x = 1;
        if (!empty($properties)) {
            foreach ($properties as $key => $property) {
                echo '<tr>
                    <td style="border-bottom: 1px solid #fffca8; width: 30px; vertical-align: top; padding: 5px; text-align: center;">' . $x . '</td>
                    <td style="border-bottom: 1px solid #fffca8; width: 80px; vertical-align: middle; padding: 5px; text-align: center;">
                        <button style="color: #1c1c1c;" class="unit-delete" data-property-id="'.$property['property']['id'].'" data-unit-id="'.$property['unit']['id'].'">Delete</button>
                    </td>
                    <td style="border-bottom: 1px solid #fffca8; width: 150px; vertical-align: top; padding: 5px;">
                        <span class="showData" style="cursor: pointer;" data-id="' . $key . '">
                        <b style="color: #fff">' . $property['property']['name'] . '</b>
                        <br>' . $key . '
                    </td>
                    <td style="border-bottom: 1px solid #fffca8; padding: 5px;"><pre class="hidden code-' . $key . '" style="color: #fff;">' . wp_unslash(json_encode($property, JSON_PRETTY_PRINT)) . '</pre></td>
                </tr>';
                $x++;
            }
        } else {
            echo '<tr><td colspan="3">NO DATA</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<div id="property_desc" class="tabData" style="display: none;">
    <pre style="background: #0d2b3e; padding: 10px; color: #fffca8;"><?= wp_unslash(json_encode($customDescription, JSON_PRETTY_PRINT)); ?></pre>
</div>
<div id="property_intro" class="tabData" style="display: none;">
    <pre style="background: #0d2b3e; padding: 10px; color: #fffca8;"><?= wp_unslash(json_encode($customIntro, JSON_PRETTY_PRINT)); ?></pre>
</div>