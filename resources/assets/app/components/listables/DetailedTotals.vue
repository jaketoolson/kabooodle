<template>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box p-a">
                <div class="pull-left m-r">
                    <span class="w-24 warn text-center rounded"><i class="material-icons">shopping_basket</i></span>
                </div>
                <div class="clear">
                    <h4 class="m-a-0 text-md">
                        <a href="">{{ qty_on_hand }} <span class="text-sm">Quantities on hand</span></a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box p-a">
                <div class="pull-left m-r">
                    <span class="w-24 warn text-center rounded"><i class="material-icons">playlist_add_check</i></span>
                </div>
                <div class="clear">
                    <h4 class="m-a-0 text-md">
                        <a href="">{{ accepted_sales }} <span class="text-sm">Accepted sales</span></a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box p-a">
                <div class="pull-left m-r">
                    <span class="w-24 warn text-center rounded"><i class="material-icons">pageview</i></span>
                </div>
                <div class="clear">
                    <h4 class="m-a-0 text-md">
                        <a href="">{{ pageviews }} <span class="text-sm">Item views</span></a>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box p-a">
                <div class="pull-left m-r">
                    <span class="w-24 warn text-center rounded"><i class="material-icons">account_balance</i></span>
                </div>
                <div class="clear">
                    <h4 class="m-a-0 text-md">
                        <a href="">{{ gross }} <span class="text-sm">Gross</span></a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: {
           gross: {
               type: String,
               required: true
           },
            pageviews: {
                type: String,
                required: true
            },
            qty_on_hand: {
                type: String,
                required: true
            },
            accepted_sales: {
                type: String,
                required: true,
            },
            pending_sales: {
                type: String,
                required: true,
            }
        }
    }
</script>
