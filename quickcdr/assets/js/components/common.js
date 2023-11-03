function send_notif(ntext, ntype) {
    if (ntype === false) {
        ntype = "danger";
    }

    $.notify({
        message: ntext
    },
    {
        type: ntype,
        placement: {
            from: "top",
            align: "right"
        },
    });
}


function get_colors(color) {
    colors = {
        blue: '#2196F3',
        indigo: '#6610f2',
        purple: '#6f42c1',
        pink: '#e83e8c',
        red: '#e51c23',
        orange: '#fd7e14',
        yellow: '#ff9800',
        green: '#4CAF50',
        teal: '#20c997',
        cyan: '#9C27B0',
        white: '#fff',
        gray: '#666',
        gray_dark: '#222',
        primary: '#2196F3',
        secondary: '#fff',
        success: '#4CAF50',
        info: '#9C27B0',
        warning: '#ff9800',
        danger: '#e51c23',
        light: '#fff',
        dark: '#222',
    };
    if (color) {
        return colors[color];
    } else {
        return colors;
    }
}