export default function () {
    return {
        extra: false,
        extra_option: "fixing_plate",
        payment_method: "cash",

        fixingPlateOnly() {
            this.extra_option = "fixing_plate";
        },

        fixingPlateWithFrame() {
            this.extra_option = "frame_with_fixing_plate";
        },

        toggleExtraOption() {
            this.extra = !this.extra;
        },

        cashPayment() {
            this.payment_method = "cash";
        },

        visaPayment() {
            this.payment_method = "visa";
        },
    };
}
