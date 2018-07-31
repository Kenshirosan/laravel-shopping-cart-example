<template>
    <coupon-layout
        info="These coupons are invalidated when customers use them"
        url="/create-coupon">
    </coupon-layout>
</template>

<script>
    import CouponLayout from './CouponLayout';

    export default {
        components: { CouponLayout },
    }
</script>