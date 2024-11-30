// validation.js
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("feedbackForm");

    form.addEventListener("submit", function (e) {
        let valid = true; // حالة التحقق
        let messages = []; // قائمة الأخطاء

        // التحقق من حقل الاسم
        const name = document.getElementById("name").value.trim();
        if (name === "") {
            valid = false;
            messages.push("Name field is required.");
        }

        // التحقق من البريد الإلكتروني
        const email = document.getElementById("email").value.trim();
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (email === "" || !emailPattern.test(email)) {
            valid = false;
            messages.push("A valid email is required.");
        }

        // التحقق من اختيار الخدمة
        const service = document.getElementById("service").value;
        if (service === "") {
            valid = false;
            messages.push("Please select a service.");
        }

        // التحقق من مستوى الرضا
        const satisfaction = document.querySelector('input[name="satisfaction"]:checked');
        if (!satisfaction) {
            valid = false;
            messages.push("Please select your satisfaction level.");
        }

        // التحقق من النصوص
        const feedback = document.getElementById("feedback").value.trim();
        if (feedback === "") {
            valid = false;
            messages.push("Feedback field is required.");
        }

        // عرض الأخطاء إذا كانت موجودة
        if (!valid) {
            e.preventDefault(); // منع الإرسال
            alert(messages.join("\n")); // عرض الأخطاء في نافذة تنبيه
        }
    });
});
