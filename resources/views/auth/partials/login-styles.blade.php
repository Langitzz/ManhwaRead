<style>
    .auth-page {
        min-height: 100vh;
        background: #0b1120;
        color: #e2e8f0;
        font-family: 'Source Sans Pro', system-ui, -apple-system, sans-serif;
    }

    .auth-card {
        background: rgba(30, 41, 59, .72);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(148, 163, 184, .12);
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
    }

    .auth-label {
        display: block;
        font-size: .875rem;
        font-weight: 600;
        color: #cbd5e1;
        margin-bottom: 8px;
    }

    .auth-field {
        position: relative;
    }

    .auth-field>.auth-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 1.05rem;
        pointer-events: none;
        z-index: 2;
    }

    .auth-input {
        height: 52px;
        border-radius: 14px;
        background: #0f172a;
        border: 1px solid #334155;
        color: #f8fafc;
        padding-left: 44px;
        transition: border-color .15s, box-shadow .15s;
    }

    .auth-input.has-toggle {
        padding-right: 48px;
    }

    .auth-input::placeholder {
        color: #64748b;
    }

    .auth-input:focus {
        background: #0f172a;
        color: #f8fafc;
        border-color: #22d3ee;
        box-shadow: 0 0 0 .2rem rgba(34, 211, 238, .15);
    }

    .auth-input.is-invalid {
        border-color: #f87171;
    }

    .auth-input.is-invalid {
        background-image: none !important;
    }

    .auth-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        padding: 4px;
        z-index: 2;
        line-height: 1;
    }

    .auth-toggle:hover {
        color: #e2e8f0;
    }

    .auth-error {
        color: #f87171;
        font-size: .85rem;
        margin-top: 6px;
    }

    .auth-alert {
        border-radius: 12px;
        padding: 12px 14px;
        font-size: .9rem;
        background: rgba(34, 197, 94, .12);
        color: #86efac;
        border: 1px solid rgba(34, 197, 94, .25);
    }

    .auth-btn {
        width: 100%;
        height: 52px;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 1rem;
        color: #fff;
        background: linear-gradient(135deg, #6366f1 0%, #22d3ee 100%);
        box-shadow: 0 10px 25px rgba(34, 211, 238, .2);
        transition: transform .15s, box-shadow .15s;
    }

    .auth-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 30px rgba(34, 211, 238, .3);
        color: #fff;
    }

    .auth-btn:active {
        transform: translateY(0);
    }

    .auth-link {
        color: #67e8f9;
        text-decoration: none;
        font-weight: 600;
    }

    .auth-link:hover {
        color: #a5f3fc;
        text-decoration: underline;
    }

    .auth-check {
        color: #cbd5e1;
        font-size: .9rem;
    }

    .auth-check .form-check-input {
        background-color: #0f172a;
        border-color: #475569;
    }

    .auth-check .form-check-input:checked {
        background-color: #22d3ee;
        border-color: #22d3ee;
    }
</style>
