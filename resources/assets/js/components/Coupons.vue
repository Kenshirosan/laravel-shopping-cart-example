<template>
    <div>
        <add-unique-coupons></add-unique-coupons>
        <add-coupons-for-everyone></add-coupons-for-everyone>
    </div>
</template>

<script>
    import UniqueCoupons from './subcomponents/UniqueCoupons'
    import CouponsForEveryone from './subcomponents/CouponsForEveryone'

    export default {
        components: { UniqueCoupons, CouponsForEveryone }
    }
</script>