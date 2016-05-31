@extends('layout')

@section('content')
    <div class="user-winner-block inventory-block">

        <div class="title-block">
            <h2>
                <?php echo trans('inventory.stoimost'); ?> - <span id="totalPrice" class="price-value">0</span> <span class="currency"><?php echo trans('inventory.rub'); ?>.</span>
            </h2>
        </div>

        <div class="user-winner-table">
            <table>
                <thead>
                <tr>
                    <td></td>
                    <td class="item-name-h"> <?php echo trans('inventory.nazvanie'); ?> </td>
                    <td class="item-type-h"><?php echo trans('inventory.type'); ?></td>
                    <td class="item-cost-h"> <?php echo trans('inventory.cena'); ?> <span>(<?php echo trans('inventory.rub'); ?>)</span></td>
                </tr>
                </thead>
                <tbody>
                <tr><td colspan="4" style="text-align: center; padding: 20px 0px; height: 100%;"> <?php echo trans('inventory.wiatloadinv'); ?>...</td></tr>
                </tbody>
            </table>
        </div>

    </div>
<script>
    $(function(){
        loadMyInventory()
    });
</script>
@endsection