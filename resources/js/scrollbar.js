(function(a) {
    function k() {
        (f = e),
        (e = null),
        d.each(function() {
            var c = a(this),
                d = c.offset().top,
                f = d + c.height(),
                g = b.scrollTop() + b.height(),
                h = 30;
            if (d + h < g && f > g) {
                e = c;
                return !1;
            }
        });
        if (!e) i();
        else {
            var c = e.scrollLeft(),
                k = e.scrollLeft(90019001).scrollLeft(),
                l = e.innerWidth(),
                m = l + k;
            e.scrollLeft(c);
            if (m <= l) {
                i();
                return;
            }
            i(!0);
            if (!f || f[0] !== e[0])
                f && f.unbind("scroll", j), e.scroll(j).after(g);
            g
                .css({ left: e.offset().left - b.scrollLeft(), width: l })
                .scrollLeft(c),
                h.width(m);
        }
    }

    function j() {
        e && g.scrollLeft(e.scrollLeft());
    }

    function i(a) {
        g.toggle(!!a);
    }
    var b = a(this),
        c = a("html"),
        d = a([]),
        e,
        f,
        g = a('<div id="floating-scrollbar"><div/></div>'),
        h = g.children();
    g
        .hide()
        .css({
            position: "fixed",
            bottom: 0,
            height: "30px",
            overflowX: "auto",
            overflowY: "hidden",
        })
        .scroll(function() {
            e && e.scrollLeft(g.scrollLeft());
        }),
        h.css({ border: "1px solid #fff", opacity: 0.01 }),
        (a.fn.floatingScrollbar = function(a) {
            a === !1 ?
                ((d = d.not(this)),
                    this.unbind("scroll", j),
                    d.length || (g.detach(), b.unbind("resize scroll", k))) :
                this.length &&
                (d.length || b.resize(k).scroll(k), (d = d.add(this))),
                k();
            return this;
        }),
        (a.floatingScrollbarUpdate = k);
})(jQuery);