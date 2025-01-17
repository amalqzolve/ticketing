/*! grapesjs-blocks-bootstrap4 - 0.1.20 */ ! function(e, t) {
    "object" == typeof exports && "object" == typeof module ? module.exports = t(require("grapesjs")) : "function" == typeof define && define.amd ? define(["grapesjs"], t) : "object" == typeof exports ? exports["grapesjs-blocks-bootstrap4"] = t(require("grapesjs")) : e["grapesjs-blocks-bootstrap4"] = t(e.grapesjs)
}(window, function(n) {
    return o = {}, r.m = a = [function(e, t) {
        e.exports = function(e) {
            return null == e ? "" : "" + e
        }
    }, function(e, t, n) {
        "use strict";
        /*
         * Underscore.string
         * (c) 2010 Esa-Matti Suuronen <esa-matti aet suuronen dot org>
         * Underscore.string is freely distributable under the terms of the MIT license.
         * Documentation: https://github.com/epeli/underscore.string
         * Some code is borrowed from MooTools and Alexandru Marasteanu.
         * Version '3.3.4'
         * @preserve
         */
        function a(e) {
            if (!(this instanceof a)) return new a(e);
            this._wrapped = e
        }

        function r(e, n) {
            "function" == typeof n && (a.prototype[e] = function() {
                var e = [this._wrapped].concat(Array.prototype.slice.call(arguments)),
                    t = n.apply(null, e);
                return "string" == typeof t ? new a(t) : t
            })
        }
        for (var o in a.VERSION = "3.3.4", a.isBlank = n(10), a.stripTags = n(27), a.capitalize = n(5), a.decapitalize = n(11), a.chop = n(28), a.trim = n(2), a.clean = n(29), a.cleanDiacritics = n(13), a.count = n(30), a.chars = n(7), a.swapCase = n(31), a.escapeHTML = n(32), a.unescapeHTML = n(34), a.splice = n(14), a.insert = n(36), a.replaceAll = n(37), a.include = n(38), a.join = n(39), a.lines = n(40), a.dedent = n(41), a.reverse = n(42), a.startsWith = n(43), a.endsWith = n(44), a.pred = n(45), a.succ = n(46), a.titleize = n(47), a.camelize = n(17), a.underscored = n(18), a.dasherize = n(19), a.classify = n(48), a.humanize = n(49), a.ltrim = n(50), a.rtrim = n(8), a.truncate = n(51), a.prune = n(52), a.words = n(53), a.pad = n(4), a.lpad = n(54), a.rpad = n(55), a.lrpad = n(56), a.sprintf = n(57), a.vsprintf = n(58), a.toNumber = n(59), a.numberFormat = n(60), a.strRight = n(61), a.strRightBack = n(62), a.strLeft = n(63), a.strLeftBack = n(64), a.toSentence = n(23), a.toSentenceSerial = n(65), a.slugify = n(66), a.surround = n(24), a.quote = n(67), a.unquote = n(68), a.repeat = n(69), a.naturalCmp = n(70), a.levenshtein = n(71), a.toBoolean = n(72), a.exports = n(73), a.escapeRegExp = n(12), a.wrap = n(74), a.map = n(75), a.strip = a.trim, a.lstrip = a.ltrim, a.rstrip = a.rtrim, a.center = a.lrpad, a.rjust = a.lpad, a.ljust = a.rpad, a.contains = a.include, a.q = a.quote, a.toBool = a.toBoolean, a.camelcase = a.camelize, a.mapChars = a.map, a.prototype = {
                value: function() {
                    return this._wrapped
                }
            }, a) r(o, a[o]);

        function i(n) {
            r(n, function(e) {
                var t = Array.prototype.slice.call(arguments, 1);
                return String.prototype[n].apply(e, t)
            })
        }
        r("tap", function(e, t) {
            return t(e)
        });
        var l = ["toUpperCase", "toLowerCase", "split", "replace", "slice", "substring", "substr", "concat"];
        for (var c in l) i(l[c]);
        e.exports = a
    }, function(e, t, n) {
        var a = n(0),
            r = n(6),
            o = String.prototype.trim;
        e.exports = function(e, t) {
            return e = a(e), !t && o ? o.call(e) : (t = r(t), e.replace(new RegExp("^" + t + "+|" + t + "+$", "g"), ""))
        }
    }, function(e, Y, t) {
        (function(X, K) {
            var J;
            ! function() {
                function n() {}
                var e = "object" == typeof self && self.self === self && self || "object" == typeof X && X.global === X && X || this || {},
                    t = e._,
                    a = Array.prototype,
                    i = Object.prototype,
                    p = "undefined" != typeof Symbol ? Symbol.prototype : null,
                    r = a.push,
                    c = a.slice,
                    d = i.toString,
                    o = i.hasOwnProperty,
                    l = Array.isArray,
                    s = Object.keys,
                    u = Object.create,
                    f = function(e) {
                        return e instanceof f ? e : this instanceof f ? void(this._wrapped = e) : new f(e)
                    };
                Y.nodeType ? e._ = f : (!K.nodeType && K.exports && (Y = K.exports = f), Y._ = f), f.VERSION = "1.9.1";

                function g(r, o, e) {
                    if (void 0 === o) return r;
                    switch (null == e ? 3 : e) {
                        case 1:
                            return function(e) {
                                return r.call(o, e)
                            };
                        case 3:
                            return function(e, t, n) {
                                return r.call(o, e, t, n)
                            };
                        case 4:
                            return function(e, t, n, a) {
                                return r.call(o, e, t, n, a)
                            }
                    }
                    return function() {
                        return r.apply(o, arguments)
                    }
                }

                function m(e, t, n) {
                    return f.iteratee !== b ? f.iteratee(e, t) : null == e ? f.identity : f.isFunction(e) ? g(e, t, n) : f.isObject(e) && !f.isArray(e) ? f.matcher(e) : f.property(e)
                }
                var b;
                f.iteratee = b = function(e, t) {
                    return m(e, t, 1 / 0)
                };

                function v(r, o) {
                    return o = null == o ? r.length - 1 : +o,
                        function() {
                            for (var e = Math.max(arguments.length - o, 0), t = Array(e), n = 0; n < e; n++) t[n] = arguments[n + o];
                            switch (o) {
                                case 0:
                                    return r.call(this, t);
                                case 1:
                                    return r.call(this, arguments[0], t);
                                case 2:
                                    return r.call(this, arguments[0], arguments[1], t)
                            }
                            var a = Array(o + 1);
                            for (n = 0; n < o; n++) a[n] = arguments[n];
                            return a[o] = t, r.apply(this, a)
                        }
                }

                function h(e) {
                    if (!f.isObject(e)) return {};
                    if (u) return u(e);
                    n.prototype = e;
                    var t = new n;
                    return n.prototype = null, t
                }

                function y(t) {
                    return function(e) {
                        return null == e ? void 0 : e[t]
                    }
                }

                function w(e, t) {
                    return null != e && o.call(e, t)
                }

                function x(e, t) {
                    for (var n = t.length, a = 0; a < n; a++) {
                        if (null == e) return;
                        e = e[t[a]]
                    }
                    return n ? e : void 0
                }

                function j(e) {
                    var t = k(e);
                    return "number" == typeof t && 0 <= t && t <= O
                }
                var O = Math.pow(2, 53) - 1,
                    k = y("length");
                f.each = f.forEach = function(e, t, n) {
                    var a, r;
                    if (t = g(t, n), j(e))
                        for (a = 0, r = e.length; a < r; a++) t(e[a], a, e);
                    else {
                        var o = f.keys(e);
                        for (a = 0, r = o.length; a < r; a++) t(e[o[a]], o[a], e)
                    }
                    return e
                }, f.map = f.collect = function(e, t, n) {
                    t = m(t, n);
                    for (var a = !j(e) && f.keys(e), r = (a || e).length, o = Array(r), i = 0; i < r; i++) {
                        var l = a ? a[i] : i;
                        o[i] = t(e[l], l, e)
                    }
                    return o
                };

                function C(c) {
                    return function(e, t, n, a) {
                        var r = 3 <= arguments.length;
                        return function(e, t, n, a) {
                            var r = !j(e) && f.keys(e),
                                o = (r || e).length,
                                i = 0 < c ? 0 : o - 1;
                            for (a || (n = e[r ? r[i] : i], i += c); 0 <= i && i < o; i += c) {
                                var l = r ? r[i] : i;
                                n = t(n, e[l], l, e)
                            }
                            return n
                        }(e, g(t, a, 4), n, r)
                    }
                }
                f.reduce = f.foldl = f.inject = C(1), f.reduceRight = f.foldr = C(-1), f.find = f.detect = function(e, t, n) {
                    var a = (j(e) ? f.findIndex : f.findKey)(e, t, n);
                    if (void 0 !== a && -1 !== a) return e[a]
                }, f.filter = f.select = function(e, a, t) {
                    var r = [];
                    return a = m(a, t), f.each(e, function(e, t, n) {
                        a(e, t, n) && r.push(e)
                    }), r
                }, f.reject = function(e, t, n) {
                    return f.filter(e, f.negate(m(t)), n)
                }, f.every = f.all = function(e, t, n) {
                    t = m(t, n);
                    for (var a = !j(e) && f.keys(e), r = (a || e).length, o = 0; o < r; o++) {
                        var i = a ? a[o] : o;
                        if (!t(e[i], i, e)) return !1
                    }
                    return !0
                }, f.some = f.any = function(e, t, n) {
                    t = m(t, n);
                    for (var a = !j(e) && f.keys(e), r = (a || e).length, o = 0; o < r; o++) {
                        var i = a ? a[o] : o;
                        if (t(e[i], i, e)) return !0
                    }
                    return !1
                }, f.contains = f.includes = f.include = function(e, t, n, a) {
                    return j(e) || (e = f.values(e)), "number" == typeof n && !a || (n = 0), 0 <= f.indexOf(e, t, n)
                }, f.invoke = v(function(e, n, a) {
                    var r, o;
                    return f.isFunction(n) ? o = n : f.isArray(n) && (r = n.slice(0, -1), n = n[n.length - 1]), f.map(e, function(e) {
                        var t = o;
                        if (!t) {
                            if (r && r.length && (e = x(e, r)), null == e) return;
                            t = e[n]
                        }
                        return null == t ? t : t.apply(e, a)
                    })
                }), f.pluck = function(e, t) {
                    return f.map(e, f.property(t))
                }, f.where = function(e, t) {
                    return f.filter(e, f.matcher(t))
                }, f.findWhere = function(e, t) {
                    return f.find(e, f.matcher(t))
                }, f.max = function(e, a, t) {
                    var n, r, o = -1 / 0,
                        i = -1 / 0;
                    if (null == a || "number" == typeof a && "object" != typeof e[0] && null != e)
                        for (var l = 0, c = (e = j(e) ? e : f.values(e)).length; l < c; l++) null != (n = e[l]) && o < n && (o = n);
                    else a = m(a, t), f.each(e, function(e, t, n) {
                        r = a(e, t, n), (i < r || r === -1 / 0 && o === -1 / 0) && (o = e, i = r)
                    });
                    return o
                }, f.min = function(e, a, t) {
                    var n, r, o = 1 / 0,
                        i = 1 / 0;
                    if (null == a || "number" == typeof a && "object" != typeof e[0] && null != e)
                        for (var l = 0, c = (e = j(e) ? e : f.values(e)).length; l < c; l++) null != (n = e[l]) && n < o && (o = n);
                    else a = m(a, t), f.each(e, function(e, t, n) {
                        ((r = a(e, t, n)) < i || r === 1 / 0 && o === 1 / 0) && (o = e, i = r)
                    });
                    return o
                }, f.shuffle = function(e) {
                    return f.sample(e, 1 / 0)
                }, f.sample = function(e, t, n) {
                    if (null == t || n) return j(e) || (e = f.values(e)), e[f.random(e.length - 1)];
                    var a = j(e) ? f.clone(e) : f.values(e),
                        r = k(a);
                    t = Math.max(Math.min(t, r), 0);
                    for (var o = r - 1, i = 0; i < t; i++) {
                        var l = f.random(i, o),
                            c = a[i];
                        a[i] = a[l], a[l] = c
                    }
                    return a.slice(0, t)
                }, f.sortBy = function(e, a, t) {
                    var r = 0;
                    return a = m(a, t), f.pluck(f.map(e, function(e, t, n) {
                        return {
                            value: e,
                            index: r++,
                            criteria: a(e, t, n)
                        }
                    }).sort(function(e, t) {
                        var n = e.criteria,
                            a = t.criteria;
                        if (n !== a) {
                            if (a < n || void 0 === n) return 1;
                            if (n < a || void 0 === a) return -1
                        }
                        return e.index - t.index
                    }), "value")
                };

                function _(i, t) {
                    return function(a, r, e) {
                        var o = t ? [
                            [],
                            []
                        ] : {};
                        return r = m(r, e), f.each(a, function(e, t) {
                            var n = r(e, t, a);
                            i(o, e, n)
                        }), o
                    }
                }
                f.groupBy = _(function(e, t, n) {
                    w(e, n) ? e[n].push(t) : e[n] = [t]
                }), f.indexBy = _(function(e, t, n) {
                    e[n] = t
                }), f.countBy = _(function(e, t, n) {
                    w(e, n) ? e[n]++ : e[n] = 1
                });
                var L = /[^\ud800-\udfff]|[\ud800-\udbff][\udc00-\udfff]|[\ud800-\udfff]/g;
                f.toArray = function(e) {
                    return e ? f.isArray(e) ? c.call(e) : f.isString(e) ? e.match(L) : j(e) ? f.map(e, f.identity) : f.values(e) : []
                }, f.size = function(e) {
                    return null == e ? 0 : j(e) ? e.length : f.keys(e).length
                }, f.partition = _(function(e, t, n) {
                    e[n ? 0 : 1].push(t)
                }, !0), f.first = f.head = f.take = function(e, t, n) {
                    return null == e || e.length < 1 ? null == t ? void 0 : [] : null == t || n ? e[0] : f.initial(e, e.length - t)
                }, f.initial = function(e, t, n) {
                    return c.call(e, 0, Math.max(0, e.length - (null == t || n ? 1 : t)))
                }, f.last = function(e, t, n) {
                    return null == e || e.length < 1 ? null == t ? void 0 : [] : null == t || n ? e[e.length - 1] : f.rest(e, Math.max(0, e.length - t))
                }, f.rest = f.tail = f.drop = function(e, t, n) {
                    return c.call(e, null == t || n ? 1 : t)
                }, f.compact = function(e) {
                    return f.filter(e, Boolean)
                };
                var T = function(e, t, n, a) {
                    for (var r = (a = a || []).length, o = 0, i = k(e); o < i; o++) {
                        var l = e[o];
                        if (j(l) && (f.isArray(l) || f.isArguments(l)))
                            if (t)
                                for (var c = 0, s = l.length; c < s;) a[r++] = l[c++];
                            else T(l, t, n, a), r = a.length;
                        else n || (a[r++] = l)
                    }
                    return a
                };
                f.flatten = function(e, t) {
                    return T(e, t, !1)
                }, f.without = v(function(e, t) {
                    return f.difference(e, t)
                }), f.uniq = f.unique = function(e, t, n, a) {
                    f.isBoolean(t) || (a = n, n = t, t = !1), null != n && (n = m(n, a));
                    for (var r = [], o = [], i = 0, l = k(e); i < l; i++) {
                        var c = e[i],
                            s = n ? n(c, i, e) : c;
                        t && !n ? (i && o === s || r.push(c), o = s) : n ? f.contains(o, s) || (o.push(s), r.push(c)) : f.contains(r, c) || r.push(c)
                    }
                    return r
                }, f.union = v(function(e) {
                    return f.uniq(T(e, !0, !0))
                }), f.intersection = function(e) {
                    for (var t = [], n = arguments.length, a = 0, r = k(e); a < r; a++) {
                        var o = e[a];
                        if (!f.contains(t, o)) {
                            var i;
                            for (i = 1; i < n && f.contains(arguments[i], o); i++);
                            i === n && t.push(o)
                        }
                    }
                    return t
                }, f.difference = v(function(e, t) {
                    return t = T(t, !0, !0), f.filter(e, function(e) {
                        return !f.contains(t, e)
                    })
                }), f.unzip = function(e) {
                    for (var t = e && f.max(e, k).length || 0, n = Array(t), a = 0; a < t; a++) n[a] = f.pluck(e, a);
                    return n
                }, f.zip = v(f.unzip), f.object = function(e, t) {
                    for (var n = {}, a = 0, r = k(e); a < r; a++) t ? n[e[a]] = t[a] : n[e[a][0]] = e[a][1];
                    return n
                };

                function S(o) {
                    return function(e, t, n) {
                        t = m(t, n);
                        for (var a = k(e), r = 0 < o ? 0 : a - 1; 0 <= r && r < a; r += o)
                            if (t(e[r], r, e)) return r;
                        return -1
                    }
                }
                f.findIndex = S(1), f.findLastIndex = S(-1), f.sortedIndex = function(e, t, n, a) {
                    for (var r = (n = m(n, a, 1))(t), o = 0, i = k(e); o < i;) {
                        var l = Math.floor((o + i) / 2);
                        n(e[l]) < r ? o = l + 1 : i = l
                    }
                    return o
                };

                function P(o, i, l) {
                    return function(e, t, n) {
                        var a = 0,
                            r = k(e);
                        if ("number" == typeof n) 0 < o ? a = 0 <= n ? n : Math.max(n + r, a) : r = 0 <= n ? Math.min(n + 1, r) : n + r + 1;
                        else if (l && n && r) return e[n = l(e, t)] === t ? n : -1;
                        if (t != t) return 0 <= (n = i(c.call(e, a, r), f.isNaN)) ? n + a : -1;
                        for (n = 0 < o ? a : r - 1; 0 <= n && n < r; n += o)
                            if (e[n] === t) return n;
                        return -1
                    }
                }
                f.indexOf = P(1, f.findIndex, f.sortedIndex), f.lastIndexOf = P(-1, f.findLastIndex), f.range = function(e, t, n) {
                    null == t && (t = e || 0, e = 0), n = n || (t < e ? -1 : 1);
                    for (var a = Math.max(Math.ceil((t - e) / n), 0), r = Array(a), o = 0; o < a; o++, e += n) r[o] = e;
                    return r
                }, f.chunk = function(e, t) {
                    if (null == t || t < 1) return [];
                    for (var n = [], a = 0, r = e.length; a < r;) n.push(c.call(e, a, a += t));
                    return n
                };

                function N(e, t, n, a, r) {
                    if (!(a instanceof t)) return e.apply(n, r);
                    var o = h(e.prototype),
                        i = e.apply(o, r);
                    return f.isObject(i) ? i : o
                }
                f.bind = v(function(t, n, a) {
                    if (!f.isFunction(t)) throw new TypeError("Bind must be called on a function");
                    var r = v(function(e) {
                        return N(t, r, n, this, a.concat(e))
                    });
                    return r
                }), f.partial = v(function(r, o) {
                    var i = f.partial.placeholder,
                        l = function() {
                            for (var e = 0, t = o.length, n = Array(t), a = 0; a < t; a++) n[a] = o[a] === i ? arguments[e++] : o[a];
                            for (; e < arguments.length;) n.push(arguments[e++]);
                            return N(r, l, this, this, n)
                        };
                    return l
                }), (f.partial.placeholder = f).bindAll = v(function(e, t) {
                    var n = (t = T(t, !1, !1)).length;
                    if (n < 1) throw new Error("bindAll must be passed function names");
                    for (; n--;) {
                        var a = t[n];
                        e[a] = f.bind(e[a], e)
                    }
                }), f.memoize = function(a, r) {
                    var o = function(e) {
                        var t = o.cache,
                            n = "" + (r ? r.apply(this, arguments) : e);
                        return w(t, n) || (t[n] = a.apply(this, arguments)), t[n]
                    };
                    return o.cache = {}, o
                }, f.delay = v(function(e, t, n) {
                    return setTimeout(function() {
                        return e.apply(null, n)
                    }, t)
                }), f.defer = f.partial(f.delay, f, 1), f.throttle = function(n, a, r) {
                    var o, i, l, c, s = 0;
                    r = r || {};

                    function u() {
                        s = !1 === r.leading ? 0 : f.now(), o = null, c = n.apply(i, l), o || (i = l = null)
                    }

                    function e() {
                        var e = f.now();
                        s || !1 !== r.leading || (s = e);
                        var t = a - (e - s);
                        return i = this, l = arguments, t <= 0 || a < t ? (o && (clearTimeout(o), o = null), s = e, c = n.apply(i, l), o || (i = l = null)) : o || !1 === r.trailing || (o = setTimeout(u, t)), c
                    }
                    return e.cancel = function() {
                        clearTimeout(o), s = 0, o = i = l = null
                    }, e
                }, f.debounce = function(n, a, r) {
                    function o(e, t) {
                        i = null, t && (l = n.apply(e, t))
                    }
                    var i, l, e = v(function(e) {
                        if (i && clearTimeout(i), r) {
                            var t = !i;
                            i = setTimeout(o, a), t && (l = n.apply(this, e))
                        } else i = f.delay(o, a, this, e);
                        return l
                    });
                    return e.cancel = function() {
                        clearTimeout(i), i = null
                    }, e
                }, f.wrap = function(e, t) {
                    return f.partial(t, e)
                }, f.negate = function(e) {
                    return function() {
                        return !e.apply(this, arguments)
                    }
                }, f.compose = function() {
                    var n = arguments,
                        a = n.length - 1;
                    return function() {
                        for (var e = a, t = n[a].apply(this, arguments); e--;) t = n[e].call(this, t);
                        return t
                    }
                }, f.after = function(e, t) {
                    return function() {
                        if (--e < 1) return t.apply(this, arguments)
                    }
                }, f.before = function(e, t) {
                    var n;
                    return function() {
                        return 0 < --e && (n = t.apply(this, arguments)), e <= 1 && (t = null), n
                    }
                }, f.once = f.partial(f.before, 2), f.restArguments = v;

                function M(e, t) {
                    var n = E.length,
                        a = e.constructor,
                        r = f.isFunction(a) && a.prototype || i,
                        o = "constructor";
                    for (w(e, o) && !f.contains(t, o) && t.push(o); n--;)(o = E[n]) in e && e[o] !== r[o] && !f.contains(t, o) && t.push(o)
                }
                var A = !{
                        toString: null
                    }.propertyIsEnumerable("toString"),
                    E = ["valueOf", "isPrototypeOf", "toString", "propertyIsEnumerable", "hasOwnProperty", "toLocaleString"];
                f.keys = function(e) {
                    if (!f.isObject(e)) return [];
                    if (s) return s(e);
                    var t = [];
                    for (var n in e) w(e, n) && t.push(n);
                    return A && M(e, t), t
                }, f.allKeys = function(e) {
                    if (!f.isObject(e)) return [];
                    var t = [];
                    for (var n in e) t.push(n);
                    return A && M(e, t), t
                }, f.values = function(e) {
                    for (var t = f.keys(e), n = t.length, a = Array(n), r = 0; r < n; r++) a[r] = e[t[r]];
                    return a
                }, f.mapObject = function(e, t, n) {
                    t = m(t, n);
                    for (var a = f.keys(e), r = a.length, o = {}, i = 0; i < r; i++) {
                        var l = a[i];
                        o[l] = t(e[l], l, e)
                    }
                    return o
                }, f.pairs = function(e) {
                    for (var t = f.keys(e), n = t.length, a = Array(n), r = 0; r < n; r++) a[r] = [t[r], e[t[r]]];
                    return a
                }, f.invert = function(e) {
                    for (var t = {}, n = f.keys(e), a = 0, r = n.length; a < r; a++) t[e[n[a]]] = n[a];
                    return t
                }, f.functions = f.methods = function(e) {
                    var t = [];
                    for (var n in e) f.isFunction(e[n]) && t.push(n);
                    return t.sort()
                };

                function D(c, s) {
                    return function(e) {
                        var t = arguments.length;
                        if (s && (e = Object(e)), t < 2 || null == e) return e;
                        for (var n = 1; n < t; n++)
                            for (var a = arguments[n], r = c(a), o = r.length, i = 0; i < o; i++) {
                                var l = r[i];
                                s && void 0 !== e[l] || (e[l] = a[l])
                            }
                        return e
                    }
                }
                f.extend = D(f.allKeys), f.extendOwn = f.assign = D(f.keys), f.findKey = function(e, t, n) {
                    t = m(t, n);
                    for (var a, r = f.keys(e), o = 0, i = r.length; o < i; o++)
                        if (t(e[a = r[o]], a, e)) return a
                };

                function z(e, t, n) {
                    return t in n
                }
                var B, I;
                f.pick = v(function(e, t) {
                    var n = {},
                        a = t[0];
                    if (null == e) return n;
                    f.isFunction(a) ? (1 < t.length && (a = g(a, t[1])), t = f.allKeys(e)) : (a = z, t = T(t, !1, !1), e = Object(e));
                    for (var r = 0, o = t.length; r < o; r++) {
                        var i = t[r],
                            l = e[i];
                        a(l, i, e) && (n[i] = l)
                    }
                    return n
                }), f.omit = v(function(e, n) {
                    var t, a = n[0];
                    return f.isFunction(a) ? (a = f.negate(a), 1 < n.length && (t = n[1])) : (n = f.map(T(n, !1, !1), String), a = function(e, t) {
                        return !f.contains(n, t)
                    }), f.pick(e, a, t)
                }), f.defaults = D(f.allKeys, !0), f.create = function(e, t) {
                    var n = h(e);
                    return t && f.extendOwn(n, t), n
                }, f.clone = function(e) {
                    return f.isObject(e) ? f.isArray(e) ? e.slice() : f.extend({}, e) : e
                }, f.tap = function(e, t) {
                    return t(e), e
                }, f.isMatch = function(e, t) {
                    var n = f.keys(t),
                        a = n.length;
                    if (null == e) return !a;
                    for (var r = Object(e), o = 0; o < a; o++) {
                        var i = n[o];
                        if (t[i] !== r[i] || !(i in r)) return !1
                    }
                    return !0
                }, B = function(e, t, n, a) {
                    if (e === t) return 0 !== e || 1 / e == 1 / t;
                    if (null == e || null == t) return !1;
                    if (e != e) return t != t;
                    var r = typeof e;
                    return ("function" == r || "object" == r || "object" == typeof t) && I(e, t, n, a)
                }, I = function(e, t, n, a) {
                    e instanceof f && (e = e._wrapped), t instanceof f && (t = t._wrapped);
                    var r = d.call(e);
                    if (r !== d.call(t)) return !1;
                    switch (r) {
                        case "[object RegExp]":
                        case "[object String]":
                            return "" + e == "" + t;
                        case "[object Number]":
                            return +e != +e ? +t != +t : 0 == +e ? 1 / +e == 1 / t : +e == +t;
                        case "[object Date]":
                        case "[object Boolean]":
                            return +e == +t;
                        case "[object Symbol]":
                            return p.valueOf.call(e) === p.valueOf.call(t)
                    }
                    var o = "[object Array]" === r;
                    if (!o) {
                        if ("object" != typeof e || "object" != typeof t) return !1;
                        var i = e.constructor,
                            l = t.constructor;
                        if (i !== l && !(f.isFunction(i) && i instanceof i && f.isFunction(l) && l instanceof l) && "constructor" in e && "constructor" in t) return !1
                    }
                    a = a || [];
                    for (var c = (n = n || []).length; c--;)
                        if (n[c] === e) return a[c] === t;
                    if (n.push(e), a.push(t), o) {
                        if ((c = e.length) !== t.length) return !1;
                        for (; c--;)
                            if (!B(e[c], t[c], n, a)) return !1
                    } else {
                        var s, u = f.keys(e);
                        if (c = u.length, f.keys(t).length !== c) return !1;
                        for (; c--;)
                            if (s = u[c], !w(t, s) || !B(e[s], t[s], n, a)) return !1
                    }
                    return n.pop(), a.pop(), !0
                }, f.isEqual = function(e, t) {
                    return B(e, t)
                }, f.isEmpty = function(e) {
                    return null == e || (j(e) && (f.isArray(e) || f.isString(e) || f.isArguments(e)) ? 0 === e.length : 0 === f.keys(e).length)
                }, f.isElement = function(e) {
                    return !(!e || 1 !== e.nodeType)
                }, f.isArray = l || function(e) {
                    return "[object Array]" === d.call(e)
                }, f.isObject = function(e) {
                    var t = typeof e;
                    return "function" == t || "object" == t && !!e
                }, f.each(["Arguments", "Function", "String", "Number", "Date", "RegExp", "Error", "Symbol", "Map", "WeakMap", "Set", "WeakSet"], function(t) {
                    f["is" + t] = function(e) {
                        return d.call(e) === "[object " + t + "]"
                    }
                }), f.isArguments(arguments) || (f.isArguments = function(e) {
                    return w(e, "callee")
                });
                var F = e.document && e.document.childNodes;
                "object" != typeof Int8Array && "function" != typeof F && (f.isFunction = function(e) {
                    return "function" == typeof e || !1
                }), f.isFinite = function(e) {
                    return !f.isSymbol(e) && isFinite(e) && !isNaN(parseFloat(e))
                }, f.isNaN = function(e) {
                    return f.isNumber(e) && isNaN(e)
                }, f.isBoolean = function(e) {
                    return !0 === e || !1 === e || "[object Boolean]" === d.call(e)
                }, f.isNull = function(e) {
                    return null === e
                }, f.isUndefined = function(e) {
                    return void 0 === e
                }, f.has = function(e, t) {
                    if (!f.isArray(t)) return w(e, t);
                    for (var n = t.length, a = 0; a < n; a++) {
                        var r = t[a];
                        if (null == e || !o.call(e, r)) return !1;
                        e = e[r]
                    }
                    return !!n
                }, f.noConflict = function() {
                    return e._ = t, this
                }, f.identity = function(e) {
                    return e
                }, f.constant = function(e) {
                    return function() {
                        return e
                    }
                }, f.noop = function() {}, f.property = function(t) {
                    return f.isArray(t) ? function(e) {
                        return x(e, t)
                    } : y(t)
                }, f.propertyOf = function(t) {
                    return null == t ? function() {} : function(e) {
                        return f.isArray(e) ? x(t, e) : t[e]
                    }
                }, f.matcher = f.matches = function(t) {
                    return t = f.extendOwn({}, t),
                        function(e) {
                            return f.isMatch(e, t)
                        }
                }, f.times = function(e, t, n) {
                    var a = Array(Math.max(0, e));
                    t = g(t, n, 1);
                    for (var r = 0; r < e; r++) a[r] = t(r);
                    return a
                }, f.random = function(e, t) {
                    return null == t && (t = e, e = 0), e + Math.floor(Math.random() * (t - e + 1))
                }, f.now = Date.now || function() {
                    return (new Date).getTime()
                };

                function H(t) {
                    function n(e) {
                        return t[e]
                    }
                    var e = "(?:" + f.keys(t).join("|") + ")",
                        a = RegExp(e),
                        r = RegExp(e, "g");
                    return function(e) {
                        return e = null == e ? "" : "" + e, a.test(e) ? e.replace(r, n) : e
                    }
                }
                var R = {
                        "&": "&amp;",
                        "<": "&lt;",
                        ">": "&gt;",
                        '"': "&quot;",
                        "'": "&#x27;",
                        "`": "&#x60;"
                    },
                    q = f.invert(R);
                f.escape = H(R), f.unescape = H(q), f.result = function(e, t, n) {
                    f.isArray(t) || (t = [t]);
                    var a = t.length;
                    if (!a) return f.isFunction(n) ? n.call(e) : n;
                    for (var r = 0; r < a; r++) {
                        var o = null == e ? void 0 : e[t[r]];
                        void 0 === o && (o = n, r = a), e = f.isFunction(o) ? o.call(e) : o
                    }
                    return e
                };
                var V = 0;
                f.uniqueId = function(e) {
                    var t = ++V + "";
                    return e ? e + t : t
                }, f.templateSettings = {
                    evaluate: /<%([\s\S]+?)%>/g,
                    interpolate: /<%=([\s\S]+?)%>/g,
                    escape: /<%-([\s\S]+?)%>/g
                };

                function $(e) {
                    return "\\" + U[e]
                }
                var Z = /(.)^/,
                    U = {
                        "'": "'",
                        "\\": "\\",
                        "\r": "r",
                        "\n": "n",
                        "\u2028": "u2028",
                        "\u2029": "u2029"
                    },
                    W = /\\|'|\r|\n|\u2028|\u2029/g;
                f.template = function(o, e, t) {
                    !e && t && (e = t), e = f.defaults({}, e, f.templateSettings);
                    var n, a = RegExp([(e.escape || Z).source, (e.interpolate || Z).source, (e.evaluate || Z).source].join("|") + "|$", "g"),
                        i = 0,
                        l = "__p+='";
                    o.replace(a, function(e, t, n, a, r) {
                        return l += o.slice(i, r).replace(W, $), i = r + e.length, t ? l += "'+\n((__t=(" + t + "))==null?'':_.escape(__t))+\n'" : n ? l += "'+\n((__t=(" + n + "))==null?'':__t)+\n'" : a && (l += "';\n" + a + "\n__p+='"), e
                    }), l += "';\n", e.variable || (l = "with(obj||{}){\n" + l + "}\n"), l = "var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};\n" + l + "return __p;\n";
                    try {
                        n = new Function(e.variable || "obj", "_", l)
                    } catch (e) {
                        throw e.source = l, e
                    }

                    function r(e) {
                        return n.call(this, e, f)
                    }
                    var c = e.variable || "obj";
                    return r.source = "function(" + c + "){\n" + l + "}", r
                }, f.chain = function(e) {
                    var t = f(e);
                    return t._chain = !0, t
                };

                function G(e, t) {
                    return e._chain ? f(t).chain() : t
                }
                f.mixin = function(n) {
                    return f.each(f.functions(n), function(e) {
                        var t = f[e] = n[e];
                        f.prototype[e] = function() {
                            var e = [this._wrapped];
                            return r.apply(e, arguments), G(this, t.apply(f, e))
                        }
                    }), f
                }, f.mixin(f), f.each(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function(t) {
                    var n = a[t];
                    f.prototype[t] = function() {
                        var e = this._wrapped;
                        return n.apply(e, arguments), "shift" !== t && "splice" !== t || 0 !== e.length || delete e[0], G(this, e)
                    }
                }), f.each(["concat", "join", "slice"], function(e) {
                    var t = a[e];
                    f.prototype[e] = function() {
                        return G(this, t.apply(this._wrapped, arguments))
                    }
                }), f.prototype.value = function() {
                    return this._wrapped
                }, f.prototype.valueOf = f.prototype.toJSON = f.prototype.value, f.prototype.toString = function() {
                    return String(this._wrapped)
                }, void 0 === (J = function() {
                    return f
                }.apply(Y, [])) || (K.exports = J)
            }()
        }).call(this, t(9), t(26)(e))
    }, function(e, t, n) {
        var o = n(0),
            i = n(20);
        e.exports = function(e, t, n, a) {
            e = o(e), t = ~~t;
            var r = 0;
            switch (n ? 1 < n.length && (n = n.charAt(0)) : n = " ", a) {
                case "right":
                    return r = t - e.length, e + i(n, r);
                case "both":
                    return r = t - e.length, i(n, Math.ceil(r / 2)) + e + i(n, Math.floor(r / 2));
                default:
                    return r = t - e.length, i(n, r) + e
            }
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            e = a(e);
            var n = t ? e.slice(1).toLowerCase() : e.slice(1);
            return e.charAt(0).toUpperCase() + n
        }
    }, function(e, t, n) {
        var a = n(12);
        e.exports = function(e) {
            return null == e ? "\\s" : e.source ? e.source : "[" + a(e) + "]"
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e) {
            return a(e).split("")
        }
    }, function(e, t, n) {
        var a = n(0),
            r = n(6),
            o = String.prototype.trimRight;
        e.exports = function(e, t) {
            return e = a(e), !t && o ? o.call(e) : (t = r(t), e.replace(new RegExp(t + "+$"), ""))
        }
    }, function(e, t) {
        var n;
        n = function() {
            return this
        }();
        try {
            n = n || new Function("return this")()
        } catch (e) {
            "object" == typeof window && (n = window)
        }
        e.exports = n
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e) {
            return /^\s*$/.test(a(e))
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e) {
            return (e = a(e)).charAt(0).toLowerCase() + e.slice(1)
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e) {
            return a(e).replace(/([.*+?^=!:${}()|[\]\/\\])/g, "\\$1")
        }
    }, function(e, t, n) {
        var a = n(0),
            r = "ąàáäâãåæăćčĉęèéëêĝĥìíïîĵłľńňòóöőôõðøśșşšŝťțţŭùúüűûñÿýçżźž",
            o = "aaaaaaaaaccceeeeeghiiiijllnnoooooooossssstttuuuuuunyyczzz";
        r += r.toUpperCase(), o = (o += o.toUpperCase()).split(""), r += "ß", o.push("ss"), e.exports = function(e) {
            return a(e).replace(/.{1}/g, function(e) {
                var t = r.indexOf(e);
                return -1 === t ? e : o[t]
            })
        }
    }, function(e, t, n) {
        var o = n(7);
        e.exports = function(e, t, n, a) {
            var r = o(e);
            return r.splice(~~t, ~~n, a), r.join("")
        }
    }, function(e, t) {
        e.exports = function(e) {
            return e < 0 ? 0 : +e || 0
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            return 0 === (e = a(e)).length ? "" : e.slice(0, -1) + String.fromCharCode(e.charCodeAt(e.length - 1) + t)
        }
    }, function(e, t, n) {
        var a = n(2),
            r = n(11);
        e.exports = function(e, t) {
            return e = a(e).replace(/[-_\s]+(.)?/g, function(e, t) {
                return t ? t.toUpperCase() : ""
            }), !0 === t ? r(e) : e
        }
    }, function(e, t, n) {
        var a = n(2);
        e.exports = function(e) {
            return a(e).replace(/([a-z\d])([A-Z]+)/g, "$1_$2").replace(/[-\s]+/g, "_").toLowerCase()
        }
    }, function(e, t, n) {
        var a = n(2);
        e.exports = function(e) {
            return a(e).replace(/([A-Z])/g, "-$1").replace(/[-_\s]+/g, "-").toLowerCase()
        }
    }, function(e, t) {
        e.exports = function(e, t) {
            if (t < 1) return "";
            for (var n = ""; 0 < t;) 1 & t && (n += e), t >>= 1, e += e;
            return n
        }
    }, function(e, t, n) {
        (function(n) {
            function a(e) {
                try {
                    if (!n.localStorage) return !1
                } catch (e) {
                    return !1
                }
                var t = n.localStorage[e];
                return null != t && "true" === String(t).toLowerCase()
            }
            e.exports = function(e, t) {
                if (a("noDeprecation")) return e;
                var n = !1;
                return function() {
                    if (!n) {
                        if (a("throwDeprecation")) throw new Error(t);
                        a("traceDeprecation") ? console.trace(t) : console.warn(t), n = !0
                    }
                    return e.apply(this, arguments)
                }
            }
        }).call(this, n(9))
    }, function(e, t, n) {
        ! function() {
            var b = {
                not_string: /[^s]/,
                number: /[diefg]/,
                json: /[j]/,
                not_json: /[^j]/,
                text: /^[^\x25]+/,
                modulo: /^\x25{2}/,
                placeholder: /^\x25(?:([1-9]\d*)\$|\(([^\)]+)\))?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-gijosuxX])/,
                key: /^([a-z_][a-z_\d]*)/i,
                key_access: /^\.([a-z_][a-z_\d]*)/i,
                index_access: /^\[(\d+)\]/,
                sign: /^[\+\-]/
            };

            function v() {
                var e = arguments[0],
                    t = v.cache;
                return t[e] && t.hasOwnProperty(e) || (t[e] = v.parse(e)), v.format.call(null, t[e], arguments)
            }
            v.format = function(e, t) {
                var n, a, r, o, i, l, c, s, u = 1,
                    p = e.length,
                    d = "",
                    f = [],
                    g = !0,
                    m = "";
                for (a = 0; a < p; a++)
                    if ("string" === (d = h(e[a]))) f[f.length] = e[a];
                    else if ("array" === d) {
                    if ((o = e[a])[2])
                        for (n = t[u], r = 0; r < o[2].length; r++) {
                            if (!n.hasOwnProperty(o[2][r])) throw new Error(v("[sprintf] property '%s' does not exist", o[2][r]));
                            n = n[o[2][r]]
                        } else n = o[1] ? t[o[1]] : t[u++];
                    if ("function" == h(n) && (n = n()), b.not_string.test(o[8]) && b.not_json.test(o[8]) && "number" != h(n) && isNaN(n)) throw new TypeError(v("[sprintf] expecting number but found %s", h(n)));
                    switch (b.number.test(o[8]) && (g = 0 <= n), o[8]) {
                        case "b":
                            n = n.toString(2);
                            break;
                        case "c":
                            n = String.fromCharCode(n);
                            break;
                        case "d":
                        case "i":
                            n = parseInt(n, 10);
                            break;
                        case "j":
                            n = JSON.stringify(n, null, o[6] ? parseInt(o[6]) : 0);
                            break;
                        case "e":
                            n = o[7] ? n.toExponential(o[7]) : n.toExponential();
                            break;
                        case "f":
                            n = o[7] ? parseFloat(n).toFixed(o[7]) : parseFloat(n);
                            break;
                        case "g":
                            n = o[7] ? parseFloat(n).toPrecision(o[7]) : parseFloat(n);
                            break;
                        case "o":
                            n = n.toString(8);
                            break;
                        case "s":
                            n = (n = String(n)) && o[7] ? n.substring(0, o[7]) : n;
                            break;
                        case "u":
                            n >>>= 0;
                            break;
                        case "x":
                            n = n.toString(16);
                            break;
                        case "X":
                            n = n.toString(16).toUpperCase()
                    }
                    b.json.test(o[8]) ? f[f.length] = n : (!b.number.test(o[8]) || g && !o[3] ? m = "" : (m = g ? "+" : "-", n = n.toString().replace(b.sign, "")), l = o[4] ? "0" === o[4] ? "0" : o[4].charAt(1) : " ", c = o[6] - (m + n).length, i = o[6] && 0 < c ? (s = l, Array(c + 1).join(s)) : "", f[f.length] = o[5] ? m + n + i : "0" === l ? m + i + n : i + m + n)
                }
                return f.join("")
            }, v.cache = {}, v.parse = function(e) {
                for (var t = e, n = [], a = [], r = 0; t;) {
                    if (null !== (n = b.text.exec(t))) a[a.length] = n[0];
                    else if (null !== (n = b.modulo.exec(t))) a[a.length] = "%";
                    else {
                        if (null === (n = b.placeholder.exec(t))) throw new SyntaxError("[sprintf] unexpected placeholder");
                        if (n[2]) {
                            r |= 1;
                            var o = [],
                                i = n[2],
                                l = [];
                            if (null === (l = b.key.exec(i))) throw new SyntaxError("[sprintf] failed to parse named argument key");
                            for (o[o.length] = l[1];
                                "" !== (i = i.substring(l[0].length));)
                                if (null !== (l = b.key_access.exec(i))) o[o.length] = l[1];
                                else {
                                    if (null === (l = b.index_access.exec(i))) throw new SyntaxError("[sprintf] failed to parse named argument key");
                                    o[o.length] = l[1]
                                }
                            n[2] = o
                        } else r |= 2;
                        if (3 === r) throw new Error("[sprintf] mixing positional and named placeholders is not (yet) supported");
                        a[a.length] = n
                    }
                    t = t.substring(n[0].length)
                }
                return a
            };

            function h(e) {
                return Object.prototype.toString.call(e).slice(8, -1).toLowerCase()
            }
            t.sprintf = v, t.vsprintf = function(e, t, n) {
                return (n = (t || []).slice(0)).splice(0, 0, e), v.apply(null, n)
            }
        }("undefined" == typeof window || window)
    }, function(e, t, n) {
        var i = n(8);
        e.exports = function(e, t, n, a) {
            t = t || ", ", n = n || " and ";
            var r = e.slice(),
                o = r.pop();
            return 2 < e.length && a && (n = i(t) + n), r.length ? r.join(t) + n + o : o
        }
    }, function(e, t) {
        e.exports = function(e, t) {
            return [t, e, t].join("")
        }
    }, function(e, t) {
        e.exports = n
    }, function(e, t) {
        e.exports = function(e) {
            return e.webpackPolyfill || (e.deprecate = function() {}, e.paths = [], e.children || (e.children = []), Object.defineProperty(e, "loaded", {
                enumerable: !0,
                get: function() {
                    return e.l
                }
            }), Object.defineProperty(e, "id", {
                enumerable: !0,
                get: function() {
                    return e.i
                }
            }), e.webpackPolyfill = 1), e
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e) {
            return a(e).replace(/<\/?[^>]+>/g, "")
        }
    }, function(e, t) {
        e.exports = function(e, t) {
            return null == e ? [] : (e = String(e), 0 < (t = ~~t) ? e.match(new RegExp(".{1," + t + "}", "g")) : [e])
        }
    }, function(e, t, n) {
        var a = n(2);
        e.exports = function(e) {
            return a(e).replace(/\s\s+/g, " ")
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            return e = a(e), t = a(t), 0 === e.length || 0 === t.length ? 0 : e.split(t).length - 1
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e) {
            return a(e).replace(/\S/g, function(e) {
                return e === e.toUpperCase() ? e.toLowerCase() : e.toUpperCase()
            })
        }
    }, function(e, t, n) {
        var a = n(0),
            r = n(33),
            o = "[";
        for (var i in r) o += i;
        o += "]";
        var l = new RegExp(o, "g");
        e.exports = function(e) {
            return a(e).replace(l, function(e) {
                return "&" + r[e] + ";"
            })
        }
    }, function(e, t) {
        e.exports = {
            "¢": "cent",
            "£": "pound",
            "¥": "yen",
            "€": "euro",
            "©": "copy",
            "®": "reg",
            "<": "lt",
            ">": "gt",
            '"': "quot",
            "&": "amp",
            "'": "#39"
        }
    }, function(e, t, n) {
        var a = n(0),
            r = n(35);
        e.exports = function(e) {
            return a(e).replace(/\&([^;]{1,10});/g, function(e, t) {
                var n;
                return t in r ? r[t] : (n = t.match(/^#x([\da-fA-F]+)$/)) ? String.fromCharCode(parseInt(n[1], 16)) : (n = t.match(/^#(\d+)$/)) ? String.fromCharCode(~~n[1]) : e
            })
        }
    }, function(e, t) {
        e.exports = {
            nbsp: " ",
            cent: "¢",
            pound: "£",
            yen: "¥",
            euro: "€",
            copy: "©",
            reg: "®",
            lt: "<",
            gt: ">",
            quot: '"',
            amp: "&",
            apos: "'"
        }
    }, function(e, t, n) {
        var a = n(14);
        e.exports = function(e, t, n) {
            return a(e, t, 0, n)
        }
    }, function(e, t, n) {
        var o = n(0);
        e.exports = function(e, t, n, a) {
            var r = new RegExp(t, !0 === a ? "gi" : "g");
            return o(e).replace(r, n)
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            return "" === t || -1 !== a(e).indexOf(t)
        }
    }, function(e, t, n) {
        var a = n(0),
            r = [].slice;
        e.exports = function() {
            var e = r.call(arguments),
                t = e.shift();
            return e.join(a(t))
        }
    }, function(e, t) {
        e.exports = function(e) {
            return null == e ? [] : String(e).split(/\r\n?|\n/)
        }
    }, function(e, t, n) {
        var r = n(0);
        e.exports = function(e, t) {
            var n, a = function(e) {
                for (var t = e.match(/^[\s\\t]*/gm), n = t[0].length, a = 1; a < t.length; a++) n = Math.min(t[a].length, n);
                return n
            }(e = r(e));
            return 0 === a ? e : (n = "string" == typeof t ? new RegExp("^" + t, "gm") : new RegExp("^[ \\t]{" + a + "}", "gm"), e.replace(n, ""))
        }
    }, function(e, t, n) {
        var a = n(7);
        e.exports = function(e) {
            return a(e).reverse().join("")
        }
    }, function(e, t, n) {
        var a = n(0),
            r = n(15);
        e.exports = function(e, t, n) {
            return e = a(e), t = "" + t, n = null == n ? 0 : Math.min(r(n), e.length), e.lastIndexOf(t, n) === n
        }
    }, function(e, t, n) {
        var a = n(0),
            r = n(15);
        e.exports = function(e, t, n) {
            return e = a(e), t = "" + t, 0 <= (n = void 0 === n ? e.length - t.length : Math.min(r(n), e.length) - t.length) && e.indexOf(t, n) === n
        }
    }, function(e, t, n) {
        var a = n(16);
        e.exports = function(e) {
            return a(e, -1)
        }
    }, function(e, t, n) {
        var a = n(16);
        e.exports = function(e) {
            return a(e, 1)
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e) {
            return a(e).toLowerCase().replace(/(?:^|\s|-)\S/g, function(e) {
                return e.toUpperCase()
            })
        }
    }, function(e, t, n) {
        var a = n(5),
            r = n(17),
            o = n(0);
        e.exports = function(e) {
            return e = o(e), a(r(e.replace(/[\W_]/g, " ")).replace(/\s/g, ""))
        }
    }, function(e, t, n) {
        var a = n(5),
            r = n(18),
            o = n(2);
        e.exports = function(e) {
            return a(o(r(e).replace(/_id$/, "").replace(/_/g, " ")))
        }
    }, function(e, t, n) {
        var a = n(0),
            r = n(6),
            o = String.prototype.trimLeft;
        e.exports = function(e, t) {
            return e = a(e), !t && o ? o.call(e) : (t = r(t), e.replace(new RegExp("^" + t + "+"), ""))
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t, n) {
            return n = n || "...", t = ~~t, (e = a(e)).length > t ? e.slice(0, t) + n : e
        }
    }, function(e, t, n) {
        var r = n(0),
            o = n(8);
        e.exports = function(e, t, n) {
            if (e = r(e), t = ~~t, n = null != n ? String(n) : "...", e.length <= t) return e;
            var a = e.slice(0, t + 1).replace(/.(?=\W*\w*$)/g, function(e) {
                return e.toUpperCase() !== e.toLowerCase() ? "A" : " "
            });
            return ((a = a.slice(a.length - 2).match(/\w\w/) ? a.replace(/\s*\S+$/, "") : o(a.slice(0, a.length - 1))) + n).length > e.length ? e : e.slice(0, a.length) + n
        }
    }, function(e, t, n) {
        var a = n(10),
            r = n(2);
        e.exports = function(e, t) {
            return a(e) ? [] : r(e, t).split(t || /\s+/)
        }
    }, function(e, t, n) {
        var a = n(4);
        e.exports = function(e, t, n) {
            return a(e, t, n)
        }
    }, function(e, t, n) {
        var a = n(4);
        e.exports = function(e, t, n) {
            return a(e, t, n, "right")
        }
    }, function(e, t, n) {
        var a = n(4);
        e.exports = function(e, t, n) {
            return a(e, t, n, "both")
        }
    }, function(e, t, n) {
        var a = n(21);
        e.exports = a(n(22).sprintf, "sprintf() will be removed in the next major release, use the sprintf-js package instead.")
    }, function(e, t, n) {
        var a = n(21);
        e.exports = a(n(22).vsprintf, "vsprintf() will be removed in the next major release, use the sprintf-js package instead.")
    }, function(e, t) {
        e.exports = function(e, t) {
            if (null == e) return 0;
            var n = Math.pow(10, isFinite(t) ? t : 0);
            return Math.round(e * n) / n
        }
    }, function(e, t) {
        e.exports = function(e, t, n, a) {
            if (isNaN(e) || null == e) return "";
            a = "string" == typeof a ? a : ",";
            var r = (e = e.toFixed(~~t)).split("."),
                o = r[0],
                i = r[1] ? (n || ".") + r[1] : "";
            return o.replace(/(\d)(?=(?:\d{3})+$)/g, "$1" + a) + i
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            e = a(e);
            var n = (t = a(t)) ? e.indexOf(t) : -1;
            return ~n ? e.slice(n + t.length, e.length) : e
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            e = a(e);
            var n = (t = a(t)) ? e.lastIndexOf(t) : -1;
            return ~n ? e.slice(n + t.length, e.length) : e
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            e = a(e);
            var n = (t = a(t)) ? e.indexOf(t) : -1;
            return ~n ? e.slice(0, n) : e
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            e = a(e), t = a(t);
            var n = e.lastIndexOf(t);
            return ~n ? e.slice(0, n) : e
        }
    }, function(e, t, n) {
        var a = n(23);
        e.exports = function(e, t, n) {
            return a(e, t, n, !0)
        }
    }, function(e, t, n) {
        var a = n(2),
            r = n(19),
            o = n(13);
        e.exports = function(e) {
            return a(r(o(e).replace(/[^\w\s-]/g, "-").toLowerCase()), "-")
        }
    }, function(e, t, n) {
        var a = n(24);
        e.exports = function(e, t) {
            return a(e, t || '"')
        }
    }, function(e, t) {
        e.exports = function(e, t) {
            return t = t || '"', e[0] === t && e[e.length - 1] === t ? e.slice(1, e.length - 1) : e
        }
    }, function(e, t, n) {
        var r = n(0),
            o = n(20);
        e.exports = function(e, t, n) {
            if (e = r(e), t = ~~t, null == n) return o(e, t);
            for (var a = []; 0 < t; a[--t] = e);
            return a.join(n)
        }
    }, function(e, t) {
        e.exports = function(e, t) {
            if (e == t) return 0;
            if (!e) return -1;
            if (!t) return 1;
            for (var n = /(\.\d+|\d+|\D+)/g, a = String(e).match(n), r = String(t).match(n), o = Math.min(a.length, r.length), i = 0; i < o; i++) {
                var l = a[i],
                    c = r[i];
                if (l !== c) {
                    var s = +l,
                        u = +c;
                    return s == s && u == u ? u < s ? 1 : -1 : l < c ? -1 : 1
                }
            }
            return a.length != r.length ? a.length - r.length : e < t ? -1 : 1
        }
    }, function(e, t, n) {
        var c = n(0);
        e.exports = function(e, t) {
            "use strict";
            if ((e = c(e)) === (t = c(t))) return 0;
            if (!e || !t) return Math.max(e.length, t.length);
            for (var n = new Array(t.length + 1), a = 0; a < n.length; ++a) n[a] = a;
            for (a = 0; a < e.length; ++a) {
                for (var r = a + 1, o = 0; o < t.length; ++o) {
                    var i = r,
                        l = i + 1;
                    l < (r = n[o] + (e.charAt(a) === t.charAt(o) ? 0 : 1)) && (r = l), (l = n[o + 1] + 1) < r && (r = l), n[o] = i
                }
                n[o] = r
            }
            return r
        }
    }, function(e, t, n) {
        var a = n(2);

        function r(e, t) {
            var n, a, r = e.toLowerCase();
            for (t = [].concat(t), n = 0; n < t.length; n += 1)
                if (a = t[n]) {
                    if (a.test && a.test(e)) return !0;
                    if (a.toLowerCase() === r) return !0
                }
        }
        e.exports = function(e, t, n) {
            return "number" == typeof e && (e = "" + e), "string" != typeof e ? !!e : !!r(e = a(e), t || ["true", "1"]) || !r(e, n || ["false", "0"]) && void 0
        }
    }, function(e, t) {
        e.exports = function() {
            var e = {};
            for (var t in this) this.hasOwnProperty(t) && !t.match(/^(?:include|contains|reverse|join|map|wrap)$/) && (e[t] = this[t]);
            return e
        }
    }, function(e, t, n) {
        var p = n(0);
        e.exports = function(e, t) {
            e = p(e);
            var n, a = (t = t || {}).width || 75,
                r = t.seperator || "\n",
                o = t.cut || !1,
                i = t.preserveSpaces || !1,
                l = t.trailingSpaces || !1;
            if (a <= 0) return e;
            if (o) {
                var c = 0;
                for (n = ""; c < e.length;) c % a == 0 && 0 < c && (n += r), n += e.charAt(c), c++;
                if (l)
                    for (; 0 < c % a;) n += " ", c++;
                return n
            }
            var s = e.split(" "),
                u = 0;
            for (n = ""; 0 < s.length;) {
                if (1 + s[0].length + u > a && 0 < u) {
                    if (i) n += " ", u++;
                    else if (l)
                        for (; u < a;) n += " ", u++;
                    n += r, u = 0
                }
                0 < u && (n += " ", u++), n += s[0], u += s[0].length, s.shift()
            }
            if (l)
                for (; u < a;) n += " ", u++;
            return n
        }
    }, function(e, t, n) {
        var a = n(0);
        e.exports = function(e, t) {
            return 0 === (e = a(e)).length || "function" != typeof t ? e : e.replace(/./g, t)
        }
    }, function(e, t, n) {
        "use strict";
        n.r(t);
        var a = n(25),
            r = n.n(a),
            o = n(3),
            y = n.n(o),
            i = n(1),
            w = n.n(i);

        function l(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function x(e) {
            var t = e.DomComponents,
                n = t.getType("default"),
                a = n.model,
                r = n.view;

            function c(e) {
                var t = e._events["change:attributes"];
                return !!t && 0 !== t.filter(function(e) {
                    return "setupToggle" === e.callback.name
                }).length
            }
            t.addType("dropdown", {
                model: a.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    l(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, a.prototype.defaults, {
                        "custom-name": "Dropdown",
                        classes: ["dropdown"],
                        droppable: "a, button, .dropdown-menu",
                        traits: [{
                            type: "select",
                            label: "Initial state",
                            name: "initial_state",
                            options: [{
                                value: "",
                                name: "Closed"
                            }, {
                                value: "show",
                                name: "Open"
                            }]
                        }].concat(a.prototype.defaults.traits)
                    }),
                    init2: function() {
                        this.append({
                            type: "button",
                            content: "Click to toggle",
                            classes: ["btn", "dropdown-toggle"]
                        })[0], this.append({
                            type: "dropdown_menu"
                        })[0];
                        this.setupToggle(null, null, {
                            force: !0
                        });
                        var e = this.components();
                        e.bind("add", this.setupToggle.bind(this)), e.bind("remove", this.setupToggle.bind(this));
                        var t = this.get("classes");
                        t.bind("add", this.setupToggle.bind(this)), t.bind("change", this.setupToggle.bind(this)), t.bind("remove", this.setupToggle.bind(this))
                    },
                    setupToggle: function(e, t, n) {
                        var a = 2 < arguments.length && void 0 !== n ? n : {},
                            r = this.components().filter(function(e) {
                                return e.getAttributes().class.split(" ").includes("dropdown-toggle")
                            })[0],
                            o = this.components().filter(function(e) {
                                return e.getAttributes().class.split(" ").includes("dropdown-menu")
                            })[0];
                        if ((!0 === a.force || !0 !== a.ignore) && r && o) {
                            c(r) || this.listenTo(r, "change:attributes", this.setupToggle), c(o) || this.listenTo(o, "change:attributes", this.setupToggle);
                            var i = r.getAttributes();
                            i.role = "button";
                            var l = o.getAttributes();
                            i.hasOwnProperty("data-toggle") || (i["data-toggle"] = "dropdown"), i.hasOwnProperty("aria-haspopup") || (i["aria-haspopup"] = !0), r.set("attributes", i, {
                                ignore: !0
                            }), i.hasOwnProperty("id") ? l["aria-labelledby"] = i.id : delete l["aria-labelledby"], o.set("attributes", l, {
                                ignore: !0
                            })
                        }
                    },
                    updated: function(e, t) {
                        if (t.hasOwnProperty("initial_state")) {
                            var n = this.components().filter(function(e) {
                                    return e.getAttributes().class.split(" ").includes("dropdown-menu")
                                })[0],
                                a = n.getAttributes();
                            a.class.split(" ").includes("show") ? (a["aria-expanded"] = !1, n.removeClass("show")) : (a["aria-expanded"] = !0, n.addClass("show"))
                        }
                    }
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("dropdown")) return {
                            type: "dropdown"
                        }
                    }
                }),
                view: r
            }), t.addType("dropdown_menu", {
                model: a.extend({
                    defaults: Object.assign({}, a.prototype.defaults, {
                        "custom-name": "Dropdown Menu",
                        classes: ["dropdown-menu"],
                        draggable: ".dropdown",
                        droppable: !0
                    }),
                    init2: function() {
                        var e = {
                            type: "link",
                            classes: ["dropdown-item"],
                            content: "Dropdown item"
                        };
                        this.append({
                            type: "header",
                            tagName: "h6",
                            classes: ["dropdown-header"],
                            content: "Dropdown header"
                        }), this.append(e), this.append({
                            type: "default",
                            classes: ["dropdown-divider"]
                        }), this.append(e)
                    }
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("dropdown-menu")) return {
                            type: "dropdown_menu"
                        }
                    }
                }),
                view: r
            })
        }

        function s(e, t) {
            var n = e.className;
            if ((n = n && n.toString()) && 0 <= n.split(" ").indexOf(t)) return 1
        }
        var c = "tabs-",
            u = "".concat(c, "container"),
            p = "".concat(c, "navigation"),
            d = "".concat(c, "panes"),
            f = "".concat(c, "tab"),
            g = "".concat(c, "tab-pane"),
            m = {
                navigationName: p,
                tabPanesName: d,
                tabName: f,
                tabPaneName: g,
                navigationSelector: '[data-gjs-type="'.concat(p, '"]'),
                tabPanesSelector: '[data-gjs-type="'.concat(d, '"]'),
                tabSelector: '[data-gjs-type="'.concat(f, '"]'),
                tabPaneSelector: '[data-gjs-type="'.concat(g, '"]'),
                containerId: "data-".concat(u),
                navigationId: "data-".concat(p),
                tabPanesId: "data-".concat(d),
                tabId: "data-".concat(f),
                tabPaneId: "data-".concat(g)
            };

        function b(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function j(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                n = e.getType("default"),
                a = n.model,
                r = n.view,
                o = m.navigationName,
                i = m.tabSelector,
                l = t.classNavigation,
                c = o;
            e.addType(c, {
                model: a.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    b(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, a.prototype.defaults, {
                        name: "Tabs Navigation",
                        copyable: 0,
                        draggable: !0,
                        droppable: i,
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "nav-tabs",
                                name: "Tabs"
                            }, {
                                value: "nav-pills",
                                name: "Pills"
                            }],
                            label: "Type"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Left"
                            }, {
                                value: "nav-fill",
                                name: "Fill"
                            }, {
                                value: "nav-justified",
                                name: "Justify"
                            }],
                            label: "Layout"
                        }]
                    }),
                    init: function() {
                        this.get("classes").pluck("name").indexOf(l) < 0 && this.addClass(l)
                    }
                }, {
                    isComponent: function(e) {
                        if (s(e, l)) return {
                            type: c
                        }
                    }
                }),
                view: r.extend({
                    init: function() {
                        var e = ["type", "layout"].map(function(e) {
                            return "change:".concat(e)
                        }).join(" ");
                        this.listenTo(this.model, e, this.render);
                        var t = this.model.components();
                        t.length || t.add('\n                        <ul class="nav nav-tabs" role="tablist">\n                          <li class="nav-item">\n                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tab 1</a>\n                          </li>\n                          <li class="nav-item">\n                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tab 2</a>\n                          </li>\n                          <li class="nav-item">\n                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tab 3</a>\n                          </li>\n                        </ul>\n                    ')
                    }
                })
            })
        }

        function v(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function O(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                n = e.getType("default"),
                a = n.model,
                r = n.view,
                o = m.tabPanesName,
                i = m.tabPaneSelector,
                l = t.classTabPanes,
                c = o;
            e.addType(c, {
                model: a.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    v(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, a.prototype.defaults, {
                        name: "Tabs Panes",
                        copyable: 0,
                        draggable: !0,
                        droppable: i
                    }),
                    init: function() {
                        this.get("classes").pluck("name").indexOf(l) < 0 && this.addClass(l)
                    }
                }, {
                    isComponent: function(e) {
                        if (s(e, l)) return {
                            type: c
                        }
                    }
                }),
                view: r.extend({
                    init: function() {
                        var e = this.model.components();
                        e.length || e.add('\n                        <div class="tab-content" id="myTabContent">\n                          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">Tab pane 1</div>\n                          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Tab pane 2</div>\n                          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Tab pane 3</div>\n                        </div>\n                    ')
                    }
                })
            })
        }

        function h(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function k(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                n = e.getType("default"),
                a = n.model,
                r = n.view,
                o = m.tabName,
                i = m.navigationSelector,
                l = t.classTab,
                c = o;
            e.addType(c, {
                model: a.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    h(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, a.prototype.defaults, {
                        name: "Tab",
                        tagName: "li",
                        copyable: !0,
                        draggable: i
                    }),
                    init: function() {
                        this.get("classes").pluck("name").indexOf(l) < 0 && this.addClass(l)
                    }
                }, {
                    isComponent: function(e) {
                        if (s(e, l)) return {
                            type: c
                        }
                    }
                }),
                view: r.extend({
                    init: function() {
                        var e = this.model.components();
                        e.length || e.add('\n              <a class="nav-link active" id="tab-1" data-toggle="tab" href="#tab-pane-1" role="tab" aria-controls="tab" aria-selected="true">Tab</a>\n          ')
                    }
                })
            })
        }

        function C(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function _(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                n = e.getType("default"),
                a = n.model,
                r = n.view,
                o = m.tabPaneName,
                i = m.tabPanesSelector,
                l = t.classTabPane,
                c = o;
            e.addType(c, {
                model: a.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    C(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, a.prototype.defaults, {
                        name: "Tab Pane",
                        copyable: !0,
                        draggable: i,
                        traits: ["id", {
                            type: "class_select",
                            options: [{
                                value: "fade",
                                name: "Fade"
                            }, {
                                value: "",
                                name: "None"
                            }],
                            label: "Animation"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Inactive"
                            }, {
                                value: "active",
                                name: "Active"
                            }],
                            label: "Is Active"
                        }]
                    }),
                    init: function() {
                        this.get("classes").pluck("name").indexOf(l) < 0 && this.addClass(l)
                    }
                }, {
                    isComponent: function(e) {
                        if (s(e, l)) return {
                            type: c
                        }
                    }
                }),
                view: r
            })
        }

        function L(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function T(e, t) {
            var n, a = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
                r = e.getType("default"),
                o = r.model,
                i = r.view;
            a.formPredefinedActions && a.formPredefinedActions.length ? (n = {
                type: "select",
                label: a.labels.trait_action,
                name: "action",
                options: []
            }, a.formPredefinedActions.forEach(function(e) {
                n.options.push({
                    value: e.value,
                    name: e.name
                })
            })) : n = {
                label: a.labels.trait_action,
                name: "action"
            }, e.addType("form", {
                model: o.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    L(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, o.prototype.defaults, {
                        droppable: ":not(form)",
                        draggable: ":not(form)",
                        traits: [{
                            type: "select",
                            label: a.labels.trait_enctype,
                            name: "enctype",
                            options: [{
                                value: "application/x-www-form-urlencoded",
                                name: "application/x-www-form-urlencoded (default)"
                            }, {
                                value: "multipart/form-data",
                                name: "multipart/form-data"
                            }, {
                                value: "text/plain",
                                name: "text/plain"
                            }]
                        }, {
                            type: "select",
                            label: a.labels.trait_method,
                            name: "method",
                            options: [{
                                value: "post",
                                name: "POST"
                            }, {
                                value: "get",
                                name: "GET"
                            }]
                        }, n]
                    }),
                    init: function() {
                        this.listenTo(this, "change:formState", this.updateFormState)
                    },
                    updateFormState: function() {
                        switch (this.get("formState")) {
                            case "success":
                                this.showState("success");
                                break;
                            case "error":
                                this.showState("error");
                                break;
                            default:
                                this.showState("normal")
                        }
                    },
                    showState: function(e) {
                        var t, n, a = e || "normal";
                        n = "success" === a ? (t = "none", "block") : "error" === a ? (t = "block", "none") : t = "none";
                        var r = this.getStateModel("success"),
                            o = this.getStateModel("error"),
                            i = r.getStyle(),
                            l = o.getStyle();
                        i.display = n, l.display = t, r.setStyle(i), o.setStyle(l)
                    },
                    getStateModel: function(e) {
                        for (var t, n = e || "success", a = this.get("components"), r = 0; r < a.length; r++) {
                            var o = a.models[r];
                            if (o.get("form-state-type") === n) {
                                t = o;
                                break
                            }
                        }
                        if (!t) {
                            var i = formMsgSuccess;
                            "error" === n && (i = formMsgError), t = a.add({
                                "form-state-type": n,
                                type: "text",
                                removable: !1,
                                copyable: !1,
                                draggable: !1,
                                attributes: {
                                    "data-form-state": n
                                },
                                content: i
                            })
                        }
                        return t
                    }
                }, {
                    isComponent: function(e) {
                        if ("FORM" === e.tagName) return {
                            type: "form"
                        }
                    }
                }),
                view: i.extend({
                    events: {
                        submit: function(e) {
                            e.preventDefault()
                        }
                    }
                })
            })
        }

        function S(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function P(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
                a = e.getType("default"),
                r = a.model,
                o = a.view;
            e.addType("input", {
                model: r.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    S(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, r.prototype.defaults, {
                        "custom-name": n.labels.input,
                        tagName: "input",
                        draggable: "form .form-group",
                        droppable: !1,
                        traits: [t.value, t.name, t.placeholder, {
                            label: n.labels.trait_type,
                            type: "select",
                            name: "type",
                            options: [{
                                value: "text",
                                name: n.labels.type_text
                            }, {
                                value: "email",
                                name: n.labels.type_email
                            }, {
                                value: "password",
                                name: n.labels.type_password
                            }, {
                                value: "number",
                                name: n.labels.type_number
                            }, {
                                value: "date",
                                name: n.labels.type_date
                            }, {
                                value: "hidden",
                                name: n.labels.type_hidden
                            }]
                        }, t.required]
                    })
                }, {
                    isComponent: function(e) {
                        if ("INPUT" === e.tagName) return {
                            type: "input"
                        }
                    }
                }),
                view: o
            })
        }

        function N(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function M(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
                a = e.getType("default"),
                r = a.model,
                o = a.view;
            e.addType("input_group", {
                model: r.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    N(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, r.prototype.defaults, {
                        "custom-name": n.labels.input_group,
                        tagName: "div",
                        traits: []
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("form_group_input")) return {
                            type: "form_group_input"
                        }
                    }
                }),
                view: o
            })
        }

        function A(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function E(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
                a = e.getType("default").view,
                r = e.getType("input").model;
            e.addType("textarea", {
                model: r.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    A(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, r.prototype.defaults, {
                        "custom-name": n.labels.textarea,
                        tagName: "textarea",
                        traits: [t.name, t.placeholder, t.required]
                    })
                }, {
                    isComponent: function(e) {
                        if ("TEXTAREA" === e.tagName) return {
                            type: "textarea"
                        }
                    }
                }),
                view: a
            })
        }

        function D(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function z(e, t, n) {
            var o = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : {},
                a = t.getType("default"),
                r = a.model,
                i = t.getType("input").model;
            t.addType("select", {
                model: r.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    D(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, i.prototype.defaults, {
                        "custom-name": o.labels.select,
                        tagName: "select",
                        traits: [n.name, {
                            label: o.labels.trait_options,
                            type: "select-options"
                        }, n.required]
                    })
                }, {
                    isComponent: function(e) {
                        if ("SELECT" === e.tagName) return {
                            type: "select"
                        }
                    }
                }),
                view: a.view.extend({
                    events: {
                        mousedown: "handleClick"
                    },
                    handleClick: function(e) {
                        e.preventDefault()
                    }
                })
            }), e.TraitManager.addType("select-options", {
                events: {
                    keyup: "onChange"
                },
                onValueChange: function() {
                    for (var e = this.model.get("value").trim().split("\n"), t = [], n = 0; n < e.length; n++) {
                        var a = e[n].split(o.optionsStringSeparator),
                            r = {
                                tagName: "option",
                                attributes: {}
                            };
                        a[1] ? r.content = a[1] : r.content = a[0], r.attributes.value = a[0], t.push(r)
                    }
                    this.target.get("components").reset(t), this.target.view.render()
                },
                getInputEl: function() {
                    if (!this.$input) {
                        for (var e = "", t = this.target.get("components"), n = 0; n < t.length; n++) {
                            var a = t.models[n],
                                r = a.get("attributes").value || "";
                            e += "".concat(r).concat(o.optionsStringSeparator).concat(a.get("content"), "\n")
                        }
                        this.$input = document.createElement("textarea"), this.$input.value = e
                    }
                    return this.$input
                }
            })
        }

        function B(t) {
            for (var e = 1; e < arguments.length; e++)
                if (e % 2) {
                    var n = null != arguments[e] ? arguments[e] : {},
                        a = Object.keys(n);
                    "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                        return Object.getOwnPropertyDescriptor(n, e).enumerable
                    }))), a.forEach(function(e) {
                        I(t, e, n[e])
                    })
                } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
            return t
        }

        function I(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function F(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function H(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
                a = e.getType("checkbox");
            e.addType("radio", {
                model: a.model.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    F(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, a.model.prototype.defaults, {
                        "custom-name": n.labels.radio,
                        attributes: {
                            type: "radio"
                        }
                    })
                }, {
                    isComponent: function(e) {
                        if ("INPUT" === e.tagName && "radio" === e.type) return {
                            type: "radio"
                        }
                        if ("INPUT" === e.tagName && "star" === e.type) return {
                            type: "star"
                        }
                         if ("INPUT" === e.tagName && "switch" === e.type) return {
                            type: "switch"
                        }
                         if ("INPUT" === e.tagName && "emoji" === e.type) return {
                            type: "emoji"
                        }
                    }
                }),
                view: a.view
            })
        }

        function R(e) {
            return function(e) {
                if (Array.isArray(e)) {
                    for (var t = 0, n = new Array(e.length); t < e.length; t++) n[t] = e[t];
                    return n
                }
            }(e) || function(e) {
                if (Symbol.iterator in Object(e) || "[object Arguments]" === Object.prototype.toString.call(e)) return Array.from(e)
            }(e) || function() {
                throw new TypeError("Invalid attempt to spread non-iterable instance")
            }()
        }

        function q(e) {
            return function(e) {
                if (Array.isArray(e)) {
                    for (var t = 0, n = new Array(e.length); t < e.length; t++) n[t] = e[t];
                    return n
                }
            }(e) || function(e) {
                if (Symbol.iterator in Object(e) || "[object Arguments]" === Object.prototype.toString.call(e)) return Array.from(e)
            }(e) || function() {
                throw new TypeError("Invalid attempt to spread non-iterable instance")
            }()
        }

        function V(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function $(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
                a = e.getType("text"),
                r = a.model,
                o = a.view;
            e.addType("label", {
                model: r.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    V(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, r.prototype.defaults, {
                        "custom-name": n.labels.label,
                        tagName: "label",
                        traits: [t.for]
                    })
                }, {
                    isComponent: function(e) {
                        if ("LABEL" == e.tagName) return {
                            type: "label"
                        }
                    }
                }),
                view: o
            })
        }

        function Z(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }

        function U(e, t) {
            var n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
                a = e.getType("default"),
                r = a.model,
                o = a.view,
                i = "file-input";
            e.addType(i, {
                model: r.extend({
                    defaults: function(t) {
                        for (var e = 1; e < arguments.length; e++)
                            if (e % 2) {
                                var n = null != arguments[e] ? arguments[e] : {},
                                    a = Object.keys(n);
                                "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                                    return Object.getOwnPropertyDescriptor(n, e).enumerable
                                }))), a.forEach(function(e) {
                                    Z(t, e, n[e])
                                })
                            } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                        return t
                    }({}, r.prototype.defaults, {
                        "custom-name": n.labels.input,
                        tagName: "input",
                        draggable: "form .form-group",
                        droppable: !1,
                        traits: [t.name, t.required, {
                            type: "checkbox",
                            label: n.labels.trait_multiple,
                            name: "multiple"
                        }]
                    })
                }, {
                    isComponent: function(e) {
                        if ("INPUT" === e.tagName && s(e, "form-control-file")) return {
                            type: i
                        }
                    }
                }),
                view: o
            })
        }

        function W(e) {
            return function(e) {
                if (Array.isArray(e)) {
                    for (var t = 0, n = new Array(e.length); t < e.length; t++) n[t] = e[t];
                    return n
                }
            }(e) || function(e) {
                if (Symbol.iterator in Object(e) || "[object Arguments]" === Object.prototype.toString.call(e)) return Array.from(e)
            }(e) || function() {
                throw new TypeError("Invalid attempt to spread non-iterable instance")
            }()
        }

        function G(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                n = ["primary", "secondary", "success", "info", "warning", "danger", "light", "dark"],
                a = n.concat(["white"]),
                r = {
                    lg: "Large",
                    sm: "Small"
                },
                o = t,
                i = e.DomComponents,
                l = o.blocks,
                c = o.blockCategories,
                s = i.getType("default"),
                u = s.model,
                p = s.view,
                d = i.getType("text"),
                f = d.model,
                g = d.view,
                m = i.getType("image"),
                b = m.model,
                v = m.view,
                h = {
                    id: {
                        name: "id",
                        label: o.labels.trait_id
                    },
                    for: {
                        name: "for",
                        label: o.labels.trait_for
                    },
                    name: {
                        name: "name",
                        label: o.labels.trait_name
                    },
                    placeholder: {
                        name: "placeholder",
                        label: o.labels.trait_placeholder
                    },
                    value: {
                        name: "value",
                        label: o.labels.trait_value
                    },
                    required: {
                        type: "checkbox",
                        name: "required",
                        label: o.labels.trait_required
                    },
                    checked: {
                        label: o.labels.trait_checked,
                        type: "checkbox",
                        name: "checked",
                        changeProp: 1
                    }
                };
            c.media && (l.image && function(e) {
                var t = e.getType("image"),
                    n = t.model,
                    a = t.view,
                    r = "bs-image";
                e.addType(r, {
                    model: n.extend({
                        defaults: Object.assign({}, n.prototype.defaults, {
                            "custom-name": "Image",
                            tagName: "img",
                            resizable: 1,
                            attributes: {
                                src: "https://dummyimage.com/800x500/999/222"
                            },
                            classes: ["img-fluid"],
                            traits: [{
                                type: "text",
                                label: "Source (URL)",
                                name: "src"
                            }, {
                                type: "text",
                                label: "Alternate text",
                                name: "alt"
                            }].concat(n.prototype.defaults.traits)
                        })
                    }, {
                        isComponent: function(e) {
                            if (e && "IMG" === e.tagName) return {
                                type: r
                            }
                        }
                    }),
                    view: a
                })
            }(i), l.video && (function(e) {
                var t = e.getType("default"),
                    n = t.model,
                    a = t.view,
                    r = "bs-video";
                e.addType(r, {
                    model: n.extend({
                        defaults: Object.assign({}, n.prototype.defaults, {
                            "custom-name": "Embed",
                            tagName: "div",
                            resizable: !1,
                            droppable: !1,
                            classes: ["embed-responsive", "embed-responsive-16by9"],
                            traits: [{
                                type: "class_select",
                                options: [{
                                    value: "embed-responsive-21by9",
                                    name: "21:9"
                                }, {
                                    value: "embed-responsive-16by9",
                                    name: "16:9"
                                }, {
                                    value: "embed-responsive-4by3",
                                    name: "4:3"
                                }, {
                                    value: "embed-responsive-1by1",
                                    name: "1:1"
                                }],
                                label: "Aspect Ratio"
                            }].concat(n.prototype.defaults.traits)
                        })
                    }, {
                        isComponent: function(e) {
                            if (e && "embed-responsive" === e.className) return {
                                type: r
                            }
                        }
                    }),
                    view: a.extend({
                        init: function() {
                            var e = ["Aspect Ratio"].map(function(e) {
                                return "change:".concat(e)
                            }).join(" ");
                            this.listenTo(this.model, e, this.render);
                            var t = this.model.components();
                            t.length || t.add('<iframe class="embed-responsive-item" src="'.concat("https://download.blender.org/peach/bigbuckbunny_movies/BigBuckBunny_320x180.mp4", '"></iframe>'))
                        }
                    })
                })
            }(i), function(e) {
                var t = e.getType("video"),
                    n = t.model,
                    a = t.view,
                    r = "bs-embed-responsive";
                e.addType(r, {
                    model: n.extend({
                        defaults: Object.assign({}, n.prototype.defaults, {
                            "custom-name": "Video",
                            resizable: !1,
                            droppable: !1,
                            draggable: !1,
                            copyable: !1,
                            classes: ["embed-responsive-item"]
                        })
                    }, {
                        isComponent: function(e) {
                            if (e && "embed-responsive-item" === e.className) return {
                                type: r
                            }
                        }
                    }),
                    view: a
                })
            }(i))), c.basic && (l.default && i.addType("default", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        tagName: "div",
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Default"
                            }].concat(W(a.map(function(e) {
                                return {
                                    value: "text-" + e,
                                    name: w.a.capitalize(e)
                                }
                            }))),
                            label: "Text color"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Default"
                            }].concat(W(a.map(function(e) {
                                return {
                                    value: "bg-" + e,
                                    name: w.a.capitalize(e)
                                }
                            }))),
                            label: "Background color"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Default"
                            }, {
                                value: "border",
                                name: "Full"
                            }, {
                                value: "border-top-0",
                                name: "No top"
                            }, {
                                value: "border-right-0",
                                name: "No right"
                            }, {
                                value: "border-bottom-0",
                                name: "No bottom"
                            }, {
                                value: "border-left-0",
                                name: "No left"
                            }, {
                                value: "border-0",
                                name: "None"
                            }],
                            label: "Border width"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Default"
                            }].concat(W(a.map(function(e) {
                                return {
                                    value: "border border-" + e,
                                    name: w.a.capitalize(e)
                                }
                            }))),
                            label: "Border color"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Default"
                            }, {
                                value: "rounded",
                                name: "Rounded"
                            }, {
                                value: "rounded-top",
                                name: "Rounded top"
                            }, {
                                value: "rounded-right",
                                name: "Rounded right"
                            }, {
                                value: "rounded-bottom",
                                name: "Rounded bottom"
                            }, {
                                value: "rounded-left",
                                name: "Rounded left"
                            }, {
                                value: "rounded-circle",
                                name: "Circle"
                            }, {
                                value: "rounded-0",
                                name: "Square"
                            }],
                            label: "Border radius"
                        }, {
                            type: "text",
                            label: "ID",
                            name: "id",
                            placeholder: "my_element"
                        }, {
                            type: "text",
                            label: "Title",
                            name: "title",
                            placeholder: "My Element"
                        }]
                    }),
                    init: function() {
                        var e = this.get("classes");
                        e.bind("add", this.classesChanged.bind(this)), e.bind("change", this.classesChanged.bind(this)), e.bind("remove", this.classesChanged.bind(this)), this.init2()
                    },
                    init2: function() {},
                    classesChanged: function() {},
                    changeType: function(e) {
                        var t = this.collection,
                            n = t.indexOf(this),
                            a = {
                                type: e,
                                style: this.getStyle(),
                                attributes: this.getAttributes(),
                                content: this.view.el.innerHTML
                            };
                        t.remove(this), t.add(a, {
                            at: n
                        }), this.destroy()
                    }
                }),
                view: p
            }), l.text && i.addType("text", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Text",
                        tagName: "div",
                        droppable: !0,
                        editable: !0
                    })
                }, {}),
                view: g
            }), l.link && function(e) {
                var t = e.DomComponents,
                    n = t.getType("text").model,
                    a = t.getType("link").view;
                t.addType("link", {
                    model: n.extend({
                        defaults: Object.assign({}, n.prototype.defaults, {
                            "custom-name": "Link",
                            tagName: "a",
                            droppable: !0,
                            editable: !0,
                            traits: [{
                                type: "text",
                                label: "Href",
                                name: "href",
                                placeholder: "https://www.grapesjs.com"
                            }, {
                                type: "select",
                                options: [{
                                    value: "",
                                    name: "This window"
                                }, {
                                    value: "_blank",
                                    name: "New window"
                                }],
                                label: "Target",
                                name: "target"
                            }, {
                                type: "select",
                                options: [{
                                    value: "",
                                    name: "None"
                                }, {
                                    value: "button",
                                    name: "Self"
                                }, {
                                    value: "collapse",
                                    name: "Collapse"
                                }, {
                                    value: "dropdown",
                                    name: "Dropdown"
                                }],
                                label: "Toggles",
                                name: "data-toggle",
                                changeProp: 1
                            }].concat(n.prototype.defaults.traits)
                        }),
                        init2: function() {
                            this.listenTo(this, "change:data-toggle", this.setupToggle), this.listenTo(this, "change:attributes", this.setupToggle)
                        },
                        setupToggle: function(e, t, n) {
                            var a = 2 < arguments.length && void 0 !== n ? n : {};
                            if (!0 !== a.ignore || !0 === a.force) {
                                console.log("setup toggle");
                                var r = this.getAttributes(),
                                    o = r.href;
                                if (delete r["data-toggle"], delete r["aria-expanded"], delete r["aria-controls"], delete r["aria-haspopup"], o && 0 < o.length && o.match(/^#/)) {
                                    console.log("link has href");
                                    var i = this.em.get("Editor").DomComponents.getWrapper().find(o);
                                    if (0 < i.length) {
                                        console.log("referenced el found");
                                        var l = i[0].getAttributes().class;
                                        if (l) {
                                            console.log("el has classes");
                                            var c = l.split(" "),
                                                s = y.a.intersection(["collapse", "dropdown-menu"], c);
                                            if (s.length) {
                                                switch (console.log("link data-toggle matches el class"), s[0]) {
                                                    case "collapse":
                                                        r["data-toggle"] = "collapse"
                                                }
                                                r["aria-expanded"] = c.includes("show"), "collapse" === s[0] && (r["aria-controls"] = o.substring(1))
                                            }
                                        }
                                    }
                                }
                                this.set("attributes", r, {
                                    ignore: !0
                                })
                            }
                        },
                        classesChanged: function(e) {
                            console.log("classes changed"), "link" === this.attributes.type && 0 < this.attributes.classes.filter(function(e) {
                                return "btn" === e.id
                            }).length && this.changeType("button")
                        }
                    }, {
                        isComponent: function(e) {
                            if (e && e.tagName && "A" === e.tagName) return {
                                type: "link"
                            }
                        }
                    }),
                    view: a
                })
            }(e, t)), c.layout && (l.container && i.addType("container", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Container",
                        tagName: "div",
                        droppable: !0,
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "container",
                                name: "Fixed"
                            }, {
                                value: "container-fluid",
                                name: "Fluid"
                            }],
                            label: "Width"
                        }].concat(u.prototype.defaults.traits)
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && (e.classList.contains("container") || e.classList.contains("container-fluid"))) return {
                            type: "container"
                        }
                    }
                }),
                view: p
            }), l.row && i.addType("row", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Row",
                        tagName: "div",
                        draggable: ".container, .container-fluid",
                        droppable: !0,
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Yes"
                            }, {
                                value: "no-gutters",
                                name: "No"
                            }],
                            label: "Gutters?"
                        }].concat(u.prototype.defaults.traits)
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("row")) return {
                            type: "row"
                        }
                    }
                }),
                view: p
            }), l.column && (i.addType("column", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Column",
                        draggable: ".row",
                        droppable: !0,
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "col",
                                name: "Equal"
                            }, {
                                value: "col-auto",
                                name: "Variable"
                            }].concat(W([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "col-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "XS Width"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }, {
                                value: "col-sm",
                                name: "Equal"
                            }, {
                                value: "col-sm-auto",
                                name: "Variable"
                            }].concat(W([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "col-sm-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "SM Width"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }, {
                                value: "col-md",
                                name: "Equal"
                            }, {
                                value: "col-md-auto",
                                name: "Variable"
                            }].concat(W([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "col-md-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "MD Width"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }, {
                                value: "col-lg",
                                name: "Equal"
                            }, {
                                value: "col-lg-auto",
                                name: "Variable"
                            }].concat(W([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "col-lg-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "LG Width"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }, {
                                value: "col-xl",
                                name: "Equal"
                            }, {
                                value: "col-xl-auto",
                                name: "Variable"
                            }].concat(W([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "col-xl-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "XL Width"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }].concat(W([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "offset-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "XS Offset"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }].concat(W([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "offset-sm-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "SM Offset"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }].concat(W([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "offset-md-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "MD Offset"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }].concat(W([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "offset-lg-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "LG Offset"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }].concat(W([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12].map(function(e) {
                                return {
                                    value: "offset-xl-" + e,
                                    name: e + "/12"
                                }
                            }))),
                            label: "XL Offset"
                        }].concat(u.prototype.defaults.traits)
                    })
                }, {
                    isComponent: function(e) {
                        var t = !1;
                        if (e && e.classList && e.classList.forEach(function(e) {
                                "col" != e && !e.match(/^col-/) || (t = !0)
                            }), t) return {
                            type: "column"
                        }
                    }
                }),
                view: p
            }), i.addType("column_break", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Column Break",
                        tagName: "div",
                        classes: ["w-100"]
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("w-100")) return {
                            type: "column_break"
                        }
                    }
                }),
                view: p
            }), i.addType("media_object", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Media Object",
                        tagName: "div",
                        classes: ["media"]
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("media")) return {
                            type: "media"
                        }
                    }
                }),
                view: p
            }), i.addType("media_body", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Media Body",
                        tagName: "div",
                        classes: ["media-body"]
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("media-body")) return {
                            type: "media_body"
                        }
                    }
                }),
                view: p
            }))), c.components && (l.alert && i.addType("alert", {
                model: f.extend({
                    defaults: Object.assign({}, f.prototype.defaults, {
                        "custom-name": "Alert",
                        tagName: "div",
                        classes: ["alert"],
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }].concat(W(n.map(function(e) {
                                return {
                                    value: "alert-" + e,
                                    name: w.a.capitalize(e)
                                }
                            }))),
                            label: "Context"
                        }].concat(f.prototype.defaults.traits)
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("alert")) return {
                            type: "alert"
                        }
                    }
                }),
                view: g
            }), l.tabs && (j(i, t), k(i, t), O(i, t), _(i, t)), l.badge && i.addType("badge", {
                model: f.extend({
                    defaults: Object.assign({}, f.prototype.defaults, {
                        "custom-name": "Badge",
                        tagName: "span",
                        classes: ["badge"],
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }].concat(W(n.map(function(e) {
                                return {
                                    value: "badge-" + e,
                                    name: w.a.capitalize(e)
                                }
                            }))),
                            label: "Context"
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "Default"
                            }, {
                                value: "badge-pill",
                                name: "Pill"
                            }],
                            label: "Shape"
                        }].concat(f.prototype.defaults.traits)
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("badge")) return {
                            type: "badge"
                        }
                    }
                }),
                view: g
            }), l.card && (i.addType("card", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Card",
                        classes: ["card"],
                        traits: [{
                            type: "checkbox",
                            label: "Image Top",
                            name: "card-img-top",
                            changeProp: 1
                        }, {
                            type: "checkbox",
                            label: "Header",
                            name: "card-header",
                            changeProp: 1
                        }, {
                            type: "checkbox",
                            label: "Image",
                            name: "card-img",
                            changeProp: 1
                        }, {
                            type: "checkbox",
                            label: "Image Overlay",
                            name: "card-img-overlay",
                            changeProp: 1
                        }, {
                            type: "checkbox",
                            label: "Body",
                            name: "card-body",
                            changeProp: 1
                        }, {
                            type: "checkbox",
                            label: "Footer",
                            name: "card-footer",
                            changeProp: 1
                        }, {
                            type: "checkbox",
                            label: "Image Bottom",
                            name: "card-img-bottom",
                            changeProp: 1
                        }].concat(u.prototype.defaults.traits)
                    }),
                    init2: function() {
                        this.listenTo(this, "change:card-img-top", this.cardImageTop), this.listenTo(this, "change:card-header", this.cardHeader), this.listenTo(this, "change:card-img", this.cardImage), this.listenTo(this, "change:card-img-overlay", this.cardImageOverlay), this.listenTo(this, "change:card-body", this.cardBody), this.listenTo(this, "change:card-footer", this.cardFooter), this.listenTo(this, "change:card-img-bottom", this.cardImageBottom), this.components().comparator = "card-order", this.set("card-img-top", !0), this.set("card-body", !0)
                    },
                    cardImageTop: function() {
                        this.createCardComponent("card-img-top")
                    },
                    cardHeader: function() {
                        this.createCardComponent("card-header")
                    },
                    cardImage: function() {
                        this.createCardComponent("card-img")
                    },
                    cardImageOverlay: function() {
                        this.createCardComponent("card-img-overlay")
                    },
                    cardBody: function() {
                        this.createCardComponent("card-body")
                    },
                    cardFooter: function() {
                        this.createCardComponent("card-footer")
                    },
                    cardImageBottom: function() {
                        this.createCardComponent("card-img-bottom")
                    },
                    createCardComponent: function(e) {
                        var t = this.get(e),
                            n = e.replace(/-/g, "_").replace(/img/g, "image"),
                            a = this.components(),
                            r = a.filter(function(e) {
                                return e.attributes.type == n
                            })[0];
                        if (t && !r) {
                            var o = a.add({
                                type: n
                            }).components();
                            "card-header" == e && o.add({
                                type: "header",
                                tagName: "h4",
                                style: {
                                    "margin-bottom": "0px"
                                },
                                content: "Card Header"
                            }), "card-img-overlay" == e && (o.add({
                                type: "header",
                                tagName: "h4",
                                classes: ["card-title"],
                                content: "Card title"
                            }), o.add({
                                type: "text",
                                tagName: "p",
                                classes: ["card-text"],
                                content: "Some quick example text to build on the card title and make up the bulk of the card's content."
                            })), "card-body" == e && (o.add({
                                type: "header",
                                tagName: "h4",
                                classes: ["card-title"],
                                content: "Card title"
                            }), o.add({
                                type: "header",
                                tagName: "h6",
                                classes: ["card-subtitle", "text-muted", "mb-2"],
                                content: "Card subtitle"
                            }), o.add({
                                type: "text",
                                tagName: "p",
                                classes: ["card-text"],
                                content: "Some quick example text to build on the card title and make up the bulk of the card's content."
                            }), o.add({
                                type: "link",
                                classes: ["card-link"],
                                href: "#",
                                content: "Card link"
                            }), o.add({
                                type: "link",
                                classes: ["card-link"],
                                href: "#",
                                content: "Another link"
                            })), this.order()
                        } else t || r.destroy()
                    },
                    order: function() {}
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("card")) return {
                            type: "card"
                        }
                    }
                }),
                view: p
            }), i.addType("card_image_top", {
                model: b.extend({
                    defaults: Object.assign({}, b.prototype.defaults, {
                        "custom-name": "Card Image Top",
                        classes: ["card-img-top"],
                        "card-order": 1
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("card-img-top")) return {
                            type: "card_image_top"
                        }
                    }
                }),
                view: v
            }), i.addType("card_header", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Card Header",
                        classes: ["card-header"],
                        "card-order": 2
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("card-header")) return {
                            type: "card_header"
                        }
                    }
                }),
                view: p
            }), i.addType("card_image", {
                model: b.extend({
                    defaults: Object.assign({}, b.prototype.defaults, {
                        "custom-name": "Card Image",
                        classes: ["card-img"],
                        "card-order": 3
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("card-img")) return {
                            type: "card_image"
                        }
                    }
                }),
                view: v
            }), i.addType("card_image_overlay", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Card Image Overlay",
                        classes: ["card-img-overlay"],
                        "card-order": 4
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("card-img-overlay")) return {
                            type: "card_image_overlay"
                        }
                    }
                }),
                view: p
            }), i.addType("card_body", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Card Body",
                        classes: ["card-body"],
                        "card-order": 5
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("card-body")) return {
                            type: "card_body"
                        }
                    }
                }),
                view: p
            }), i.addType("card_footer", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Card Footer",
                        classes: ["card-footer"],
                        "card-order": 6
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("card-footer")) return {
                            type: "card_footer"
                        }
                    }
                }),
                view: p
            }), i.addType("card_image_bottom", {
                model: b.extend({
                    defaults: Object.assign({}, b.prototype.defaults, {
                        "custom-name": "Card Image Bottom",
                        classes: ["card-img-bottom"],
                        "card-order": 7
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && e.classList.contains("card-img-bottom")) return {
                            type: "card_image_bottom"
                        }
                    }
                }),
                view: v
            }), i.addType("card_container", {
                model: u.extend({
                    defaults: Object.assign({}, u.prototype.defaults, {
                        "custom-name": "Card Container",
                        classes: ["card-group"],
                        droppable: ".card",
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "card-group",
                                name: "Group"
                            }, {
                                value: "card-deck",
                                name: "Deck"
                            }, {
                                value: "card-columns",
                                name: "Columns"
                            }],
                            label: "Layout"
                        }].concat(u.prototype.defaults.traits)
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.classList && y.a.intersection(e.classList, ["card-group", "card-deck", "card-columns"]).length) return {
                            type: "card_container"
                        }
                    }
                }),
                view: p
            })), l.collapse && function(e) {
                var t = e.DomComponents,
                    n = t.getType("default"),
                    a = n.model,
                    r = n.view;
                t.addType("collapse", {
                    model: a.extend({
                        defaults: Object.assign({}, a.prototype.defaults, {
                            "custom-name": "Dropdown",
                            classes: ["collapse"],
                            droppable: !0,
                            traits: [{
                                type: "class_select",
                                options: [{
                                    value: "",
                                    name: "Closed"
                                }, {
                                    value: "show",
                                    name: "Open"
                                }],
                                label: "Initial state"
                            }].concat(a.prototype.defaults.traits)
                        })
                    }, {
                        isComponent: function(e) {
                            if (e && e.classList && e.classList.contains("dropdown")) return {
                                type: "dropdown"
                            }
                        }
                    }),
                    view: r.extend({})
                })
            }(e, t), l.dropdown && x(e, t)), c.typography && (l.header && i.addType("header", {
                model: f.extend({
                    defaults: Object.assign({}, f.prototype.defaults, {
                        "custom-name": "Header",
                        tagName: "h1",
                        traits: [{
                            type: "select",
                            options: [{
                                value: "h1",
                                name: "One (largest)"
                            }, {
                                value: "h2",
                                name: "Two"
                            }, {
                                value: "h3",
                                name: "Three"
                            }, {
                                value: "h4",
                                name: "Four"
                            }, {
                                value: "h5",
                                name: "Five"
                            }, {
                                value: "h6",
                                name: "Six (smallest)"
                            }],
                            label: "Size",
                            name: "tagName",
                            changeProp: 1
                        }, {
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "None"
                            }, {
                                value: "display-1",
                                name: "One (largest)"
                            }, {
                                value: "display-2",
                                name: "Two "
                            }, {
                                value: "display-3",
                                name: "Three "
                            }, {
                                value: "display-4",
                                name: "Four (smallest)"
                            }],
                            label: "Display Heading"
                        }].concat(f.prototype.defaults.traits)
                    })
                }, {
                    isComponent: function(e) {
                        if (e && ["H1", "H2", "H3", "H4", "H5", "H6"].includes(e.tagName)) return {
                            type: "header"
                        }
                    }
                }),
                view: g
            }), l.paragraph && i.addType("paragraph", {
                model: f.extend({
                    defaults: Object.assign({}, f.prototype.defaults, {
                        "custom-name": "Paragraph",
                        tagName: "p",
                        traits: [{
                            type: "class_select",
                            options: [{
                                value: "",
                                name: "No"
                            }, {
                                value: "lead",
                                name: "Yes"
                            }],
                            label: "Lead?"
                        }].concat(f.prototype.defaults.traits)
                    })
                }, {
                    isComponent: function(e) {
                        if (e && e.tagName && "P" === e.tagName) return {
                            type: "paragraph"
                        }
                    }
                }),
                view: g
            })), c.forms && (T(i, h, t), P(i, h, t), U(i, h, t), M(i, h, t), E(i, h, t), z(e, i, h, t), function(e, t) {
                var n = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
                    a = e.getType("default"),
                    r = a.model,
                    o = a.view,
                    i = e.getType("input").model;
                e.addType("checkbox", {
                    model: r.extend({
                        defaults: B({}, i.prototype.defaults, {
                            "custom-name": n.labels.checkbox_name,
                            copyable: !1,
                            droppable: !1,
                            attributes: {
                                type: "checkbox"
                            },
                            traits: [t.id, t.name, t.value, t.required, t.checked]
                        }),
                        init: function() {
                            this.listenTo(this, "change:checked", this.handleChecked)
                        },
                        handleChecked: function() {
                            var e = this.get("checked"),
                                t = this.get("attributes"),
                                n = this.view;
                            e ? t.checked = !0 : delete t.checked, n && (n.el.checked = e), this.set("attributes", B({}, t))
                        }
                    }, {
                        isComponent: function(e) {
                            if ("INPUT" === e.tagName && "checkbox" === e.type) return {
                                type: "checkbox"
                            }
                        }
                    }),
                    view: o.extend({
                        events: {
                            click: "handleClick"
                        },
                        handleClick: function(e) {
                            e.preventDefault()
                        }
                    })
                })
            }(i, h, t), H(i, h, t), $(i, h, t), l.button && function(e, t, n, a) {
                var r = e.getType("link"),
                    o = r.model,
                    i = r.view;
                e.addType("button", {
                    model: o.extend({
                        defaults: Object.assign({}, o.prototype.defaults, {
                            "custom-name": "Button",
                            droppable: !1,
                            attributes: {
                                role: "button"
                            },
                            classes: ["btn"],
                            traits: [{
                                type: "class_select",
                                options: [{
                                    value: "",
                                    name: "None"
                                }].concat(R(n.map(function(e) {
                                    return {
                                        value: "btn-" + e,
                                        name: w.a.capitalize(e)
                                    }
                                })), R(n.map(function(e) {
                                    return {
                                        value: "btn-outline-" + e,
                                        name: w.a.capitalize(e) + " (Outline)"
                                    }
                                }))),
                                label: "Context"
                            }, {
                                type: "class_select",
                                options: [{
                                    value: "",
                                    name: "Default"
                                }].concat(R(Object.keys(a).map(function(e) {
                                    return {
                                        value: "btn-" + e,
                                        name: a[e]
                                    }
                                }))),
                                label: "Size"
                            }, {
                                type: "class_select",
                                options: [{
                                    value: "",
                                    name: "Inline"
                                }, {
                                    value: "btn-block",
                                    name: "Block"
                                }],
                                label: "Width"
                            }].concat(o.prototype.defaults.traits)
                        }),
                        afterChange: function(e) {
                            "button" == this.attributes.type && 0 == this.attributes.classes.filter(function(e) {
                                return "btn" == e.id
                            }).length && this.changeType("link")
                        }
                    }, {
                        isComponent: function(e) {
                            if (e && e.classList && e.classList.contains("btn")) return {
                                type: "button"
                            }
                        }
                    }),
                    view: i
                })
            }(i, h, n, r, t), l.button_group && function(e, t, n, a) {
                var r = e.getType("default"),
                    o = r.model,
                    i = r.view;
                e.addType("button_group", {
                    model: o.extend({
                        defaults: Object.assign({}, o.prototype.defaults, {
                            "custom-name": "Button Group",
                            tagName: "div",
                            classes: ["btn-group"],
                            droppable: ".btn",
                            attributes: {
                                role: "group"
                            },
                            traits: [{
                                type: "class_select",
                                options: [{
                                    value: "",
                                    name: "Default"
                                }].concat(q(Object.keys(a).map(function(e) {
                                    return {
                                        value: "btn-group-" + e,
                                        name: a[e]
                                    }
                                }))),
                                label: "Size"
                            }, {
                                type: "class_select",
                                options: [{
                                    value: "",
                                    name: "Horizontal"
                                }, {
                                    value: "btn-group-vertical",
                                    name: "Vertical"
                                }],
                                label: "Size"
                            }, {
                                type: "Text",
                                label: "ARIA Label",
                                name: "aria-label",
                                placeholder: "A group of buttons"
                            }].concat(o.prototype.defaults.traits)
                        })
                    }, {
                        isComponent: function(e) {
                            if (e && e.classList && e.classList.contains("btn-group")) return {
                                type: "button_group"
                            }
                        }
                    }),
                    view: i
                })
            }(i, h, n, r, t), l.button_toolbar && function(e) {
                var t = e.getType("default"),
                    n = t.model,
                    a = t.view;
                e.addType("button_toolbar", {
                    model: n.extend({
                        defaults: Object.assign({}, n.prototype.defaults, {
                            "custom-name": "Button Toolbar",
                            tagName: "div",
                            classes: ["btn-toolbar"],
                            droppable: ".btn-group",
                            attributes: {
                                role: "toolbar"
                            },
                            traits: [{
                                type: "Text",
                                label: "ARIA Label",
                                name: "aria-label",
                                placeholder: "A toolbar of button groups"
                            }].concat(n.prototype.defaults.traits)
                        })
                    }, {
                        isComponent: function(e) {
                            if (e && e.classList && e.classList.contains("btn-toolbar")) return {
                                type: "button_toolbar"
                            }
                        }
                    }),
                    view: a
                })
            }(i, t))
        }
        var X = '<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="columns" class="svg-inline--fa fa-columns fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64V160h160v256zm224 0H288V160h160v256z"></path></svg>\r\n',
            K = '<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="credit-card" class="svg-inline--fa fa-credit-card fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V256H0v176zm192-68c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-40zm-128 0c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM576 80v48H0V80c0-26.5 21.5-48 48-48h480c26.5 0 48 21.5 48 48z"></path></svg>\r\n',
            J = '<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,9 C22,8.4 21.5,8 20.75,8 L3.25,8 C2.5,8 2,8.4 2,9 L2,15 C2,15.6 2.5,16 3.25,16 L20.75,16 C21.5,16 22,15.6 22,15 L22,9 Z M21,15 L3,15 L3,9 L21,9 L21,15 Z" fill-rule="nonzero"></path>\r\n    <rect class="gjs-block-svg-path" x="4" y="11.5" width="16" height="1"></rect>\r\n</svg>\r\n',
            Y = '<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="window-maximize" class="svg-inline--fa fa-window-maximize fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-16 160H64v-84c0-6.6 5.4-12 12-12h360c6.6 0 12 5.4 12 12v84z"></path></svg>\r\n';

        function Q(e, t, n) {
            return t in e ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = n, e
        }
        t.default = r.a.plugins.add("grapesjs-blocks-bootstrap4", function(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {};
            window.editor = e;
            var n = t.blocks || {},
                a = t.labels || {},
                r = t.blockCategories || {};
            delete t.blocks, delete t.labels, delete t.blockCategories;
            var o = function(t) {
                for (var e = 1; e < arguments.length; e++)
                    if (e % 2) {
                        var n = null != arguments[e] ? arguments[e] : {},
                            a = Object.keys(n);
                        "function" == typeof Object.getOwnPropertySymbols && (a = a.concat(Object.getOwnPropertySymbols(n).filter(function(e) {
                            return Object.getOwnPropertyDescriptor(n, e).enumerable
                        }))), a.forEach(function(e) {
                            Q(t, e, n[e])
                        })
                    } else Object.defineProperties(t, Object.getOwnPropertyDescriptors(arguments[e]));
                return t
            }({}, {
                blocks: Object.assign({
                    default: !0,
                    text: !0,
                    link: !0,
                    image: !0,
                    container: !0,
                    row: !0,
                    column: !0,
                    column_break: !0,
                    media_object: !0,
                    alert: !0,
                    tabs: !0,
                    badge: !0,
                    button: !0,
                    button_group: !0,
                    button_toolbar: !0,
                    card: !0,
                    card_container: !0,
                    collapse: !0,
                    dropdown: !0,
                    video: !0,
                    header: !0,
                    paragraph: !0,
                    list: !0,
                    form: !0,
                    input: !0,
                    form_group_input: !0,
                    input_group: !0,
                    textarea: !0,
                    select: !0,
                    label: !0,
                    checkbox: !0,
                    radio: !0,
                    star: !0,
                    switch: !0,
                    emoji: !0,
                }, n),
                labels: Object.assign({
                    container: "Container",
                    row: "Row",
                    column: "Column",
                    column_break: "Column Break",
                    media_object: "Media Object",
                    alert: "Alert",
                    tabs: "Tabs",
                    tab: "Tab",
                    tabPane: "Tab Pane",
                    badge: "Badge",
                    button: "Button",
                    button_group: "Button Group",
                    button_toolbar: "Button Toolbar",
                    card: "Card",
                    card_container: "Card Container",
                    collapse: "Collapse",
                    dropdown: "Dropdown",
                    dropdown_menu: "Dropdown Menu",
                    dropdown_item: "Dropdown Item",
                    image: "Image",
                    video: "Video",
                    text: "Text",
                    header: "Header",
                    paragraph: "Paragraph",
                    link: "Link",
                    list: "Simple List",
                    form: "Form",
                    input: "Input",
                    file_input: "File",
                    form_group_input: "Form Group",
                    input_group: "Input group",
                    textarea: "Textarea",
                    select: "Select",
                    select_option: "- Select option -",
                    option: "Option",
                    label: "Label",
                    checkbox: "Checkbox",
                    radio: "Radio",
                    star: "Star Rating",
                    emoji: "Emoji Rating",
                    switch: "Switch",
                    trait_method: "Method",
                    trait_enctype: "Encoding Type",
                    trait_multiple: "Multiple",
                    trait_action: "Action",
                    trait_state: "State",
                    trait_id: "ID",
                    trait_for: "For",
                    trait_name: "Name",
                    trait_placeholder: "Placeholder",
                    trait_value: "Value",
                    trait_required: "Required",
                    trait_type: "Type",
                    trait_options: "Options",
                    trait_checked: "Checked",
                    type_text: "Text",
                    type_email: "Email",
                    type_password: "Password",
                    type_number: "Number",
                    type_date: "Date",
                    type_hidden: "Hidden",
                    type_submit: "Submit",
                    type_reset: "Reset",
                    type_button: "Button"
                }, a),
                blockCategories: Object.assign({
                    layout: !0,
                    media: !0,
                    components: !0,
                    typography: !0,
                    basic: !0,
                    forms: !0
                }, r),
                optionsStringSeparator: "::",
                gridDevices: !0,
                gridDevicesPanel: !1,
                classNavigation: "nav",
                classTabPanes: "tab-content",
                classTabPane: "tab-pane",
                classTab: "nav-item"
            }, {}, t);
            ! function(e) {
                e.Commands
            }(e, o),
            function(e) {
                e.TraitManager.addType("class_select", {
                    events: {
                        change: "onChange"
                    },
                    getInputEl: function() {
                        if (!this.inputEl) {
                            for (var e = this.model.get("options") || [], t = document.createElement("select"), n = (this.target, this.target.view.el), a = 0; a < e.length; a++) {
                                var r = e[a].name,
                                    o = e[a].value;
                                "" == o && (o = "GJS_NO_CLASS");
                                var i = document.createElement("option");
                                i.text = r;
                                var l = (i.value = o).split(" ");
                                y.a.intersection(n.classList, l).length == l.length && i.setAttribute("selected", "selected"), t.append(i)
                            }
                            this.inputEl = t
                        }
                        return this.inputEl
                    },
                    onValueChange: function() {
                        for (var e = this.model.get("options").map(function(e) {
                                return e.value
                            }), t = 0; t < e.length; t++)
                            if (0 < e[t].length)
                                for (var n = e[t].split(" "), a = 0; a < n.length; a++) 0 < n[a].length && this.target.removeClass(n[a]);
                        var r = this.model.get("value");
                        if (0 < r.length && "GJS_NO_CLASS" != r)
                            for (var o = r.split(" "), i = 0; i < o.length; i++) this.target.addClass(o[i]);
                        this.target.em.trigger("change:selectedComponent")
                    }
                })
            }(e, o), G(e, o),
                function(e) {
                    var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                        n = e.BlockManager,
                        a = t.blocks,
                        r = t.blockCategories;
                    r.layout && (a.container && n.add("container").set({
                        label: "\n            ".concat(Y, "\n            <div>").concat(t.labels.container, "</div>\n        "),
                        category: "Layout",
                        content: {
                            type: "container",
                            classes: ["container"]
                        }
                    }), a.row && n.add("row").set({
                        label: "\n            ".concat(Y, "\n            <div>").concat(t.labels.row, "</div>\n        "),
                        category: "Layout",
                        content: {
                            type: "row",
                            classes: ["row"]
                        }
                    }), a.column && n.add("column").set({
                        label: "\n            ".concat(X, "\n            <div>").concat(t.labels.column, "</div>\n        "),
                        category: "Layout",
                        content: {
                            type: "column",
                            classes: ["col"]
                        }
                    }), a.column_break && n.add("column_break").set({
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="equals" class="svg-inline--fa fa-equals fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 304H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32zm0-192H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>\r\n', "\n            <div>").concat(t.labels.column_break, "</div>\n        "),
                        category: "Layout",
                        content: {
                            type: "column_break"
                        }
                    }), a.media_object && n.add("media_object").set({
                        label: "\n            ".concat(X, "\n            <div>").concat(t.labels.media_object, "</div>\n        "),
                        category: "Layout",
                        content: '<div class="media">\n                 <img class="mr-3" src="">\n                 <div class="media-body">\n                 <h5>Media heading</h5>\n                 <div>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</div>\n                 </div>\n                 </div>'
                    })), r.media && (a.video && n.add("bs-video", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>\r\n', "\n            <div>").concat(t.labels.video, "</div>\n        "),
                        category: "Media",
                        content: {
                            type: "bs-video"
                        }
                    }), a.image && n.add("bs-image", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="image" class="svg-inline--fa fa-image fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"></path></svg>\r\n', "\n            <div>").concat(t.labels.image, "</div>\n        "),
                        category: "Media",
                        content: {
                            type: "bs-image"
                        }
                    })), r.components && (a.alert && n.add("alert", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="exclamation-triangle" class="svg-inline--fa fa-exclamation-triangle fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"></path></svg>\r\n', "\n            <div>").concat(t.labels.alert, "</div>\n        "),
                        category: "Components",
                        content: {
                            type: "alert",
                            content: "This is an alert—check it out!"
                        }
                    }), a.tabs && (n.add("tabs", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="ellipsis-h" class="svg-inline--fa fa-ellipsis-h fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path></svg>\r\n', "\n            <div>").concat(t.labels.tabs, "</div>\n        "),
                        category: "Components",
                        content: '\n            <ul class="nav nav-tabs" role="tablist">\n              <li class="nav-item">\n                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tab 1</a>\n              </li>\n              <li class="nav-item">\n                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tab 2</a>\n              </li>\n              <li class="nav-item">\n                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tab 3</a>\n              </li>\n            </ul>\n            <div class="tab-content">\n              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"></div>\n              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"></div>\n              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"></div>\n            </div>\n        '
                    }), n.add("tabs-tab", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="circle" class="svg-inline--fa fa-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg>\r\n', "\n            <div>").concat(t.labels.tab, "</div>\n        "),
                        category: "Components",
                        content: {
                            type: "tabs-tab"
                        }
                    }), n.add("tabs-tab-pane", {
                        label: "\n            ".concat(Y, "\n            <div>").concat(t.labels.tabPane, "</div>\n        "),
                        category: "Components",
                        content: {
                            type: "tabs-tab-pane"
                        }
                    })), a.badge && n.add("badge", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="certificate" class="svg-inline--fa fa-certificate fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M458.622 255.92l45.985-45.005c13.708-12.977 7.316-36.039-10.664-40.339l-62.65-15.99 17.661-62.015c4.991-17.838-11.829-34.663-29.661-29.671l-61.994 17.667-15.984-62.671C337.085.197 313.765-6.276 300.99 7.228L256 53.57 211.011 7.229c-12.63-13.351-36.047-7.234-40.325 10.668l-15.984 62.671-61.995-17.667C74.87 57.907 58.056 74.738 63.046 92.572l17.661 62.015-62.65 15.99C.069 174.878-6.31 197.944 7.392 210.915l45.985 45.005-45.985 45.004c-13.708 12.977-7.316 36.039 10.664 40.339l62.65 15.99-17.661 62.015c-4.991 17.838 11.829 34.663 29.661 29.671l61.994-17.667 15.984 62.671c4.439 18.575 27.696 24.018 40.325 10.668L256 458.61l44.989 46.001c12.5 13.488 35.987 7.486 40.325-10.668l15.984-62.671 61.994 17.667c17.836 4.994 34.651-11.837 29.661-29.671l-17.661-62.015 62.65-15.99c17.987-4.302 24.366-27.367 10.664-40.339l-45.984-45.004z"></path></svg>\r\n', "\n            <div>").concat(t.labels.badge, "</div>\n        "),
                        category: "Components",
                        content: {
                            type: "badge",
                            content: "New!"
                        }
                    }), a.card && (n.add("card", {
                        label: "\n            ".concat(K, "\n            <div>").concat(t.labels.card, "</div>\n        "),
                        category: "Components",
                        content: {
                            type: "card"
                        }
                    }), n.add("card_container", {
                        label: "\n            ".concat(K, "\n            <div>").concat(t.labels.card_container, "</div>\n        "),
                        category: "Components",
                        content: {
                            type: "card_container"
                        }
                    })), a.collapse && n.add("collapse", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="compress" class="svg-inline--fa fa-compress fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M436 192H312c-13.3 0-24-10.7-24-24V44c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v84h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-276-24V44c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v84H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24zm0 300V344c0-13.3-10.7-24-24-24H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-84h84c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12H312c-13.3 0-24 10.7-24 24v124c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12z"></path></svg>\r\n', "\n            <div>").concat(t.labels.collapse, "</div>\n        "),
                        category: "Components",
                        content: {
                            type: "collapse"
                        }
                    }), a.dropdown && n.add("dropdown", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="far" data-icon="caret-square-down" class="svg-inline--fa fa-caret-square-down fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M125.1 208h197.8c10.7 0 16.1 13 8.5 20.5l-98.9 98.3c-4.7 4.7-12.2 4.7-16.9 0l-98.9-98.3c-7.7-7.5-2.3-20.5 8.4-20.5zM448 80v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48zm-48 346V86c0-3.3-2.7-6-6-6H54c-3.3 0-6 2.7-6 6v340c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"></path></svg>\r\n', "\n            <div>").concat(t.labels.dropdown, "</div>\n        "),
                        category: "Components",
                        content: {
                            type: "dropdown"
                        }
                    })), r.typography && (a.text && n.add("text", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="font" class="svg-inline--fa fa-font fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 416h-23.41L277.88 53.69A32 32 0 0 0 247.58 32h-47.16a32 32 0 0 0-30.3 21.69L39.41 416H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16h-19.58l23.3-64h152.56l23.3 64H304a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zM176.85 272L224 142.51 271.15 272z"></path></svg>\r\n', "\n            <div>").concat(t.labels.text, "</div>\n        "),
                        category: "Typography",
                        content: {
                            type: "text",
                            content: "Insert your text here"
                        }
                    }), a.header && n.add("header", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="heading" class="svg-inline--fa fa-heading fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M448 96v320h32a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16H320a16 16 0 0 1-16-16v-32a16 16 0 0 1 16-16h32V288H160v128h32a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16H32a16 16 0 0 1-16-16v-32a16 16 0 0 1 16-16h32V96H32a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h160a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16h-32v128h192V96h-32a16 16 0 0 1-16-16V48a16 16 0 0 1 16-16h160a16 16 0 0 1 16 16v32a16 16 0 0 1-16 16z"></path></svg>\r\n', "\n            <div>").concat(t.labels.header, "</div>\n        "),
                        category: "Typography",
                        content: {
                            type: "header",
                            content: "Bootstrap heading"
                        }
                    }), a.paragraph && n.add("paragraph", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="paragraph" class="svg-inline--fa fa-paragraph fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M448 48v32a16 16 0 0 1-16 16h-48v368a16 16 0 0 1-16 16h-32a16 16 0 0 1-16-16V96h-32v368a16 16 0 0 1-16 16h-32a16 16 0 0 1-16-16V352h-32a160 160 0 0 1 0-320h240a16 16 0 0 1 16 16z"></path></svg>\r\n', "\n            <div>").concat(t.labels.paragraph, "</div>\n        "),
                        category: "Typography",
                        content: {
                            type: "paragraph",
                            content: "Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus."
                        }
                    })), r.basic && a.link && n.add("link", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="link" class="svg-inline--fa fa-link fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"></path></svg>\r\n', "\n            <div>").concat(t.labels.link, "</div>\n        "),
                        category: "Basic",
                        content: {
                            type: "link",
                            content: "Link text"
                        }
                    }), a.form && n.add("form", {
                        label: "\n      ".concat('<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,5.5 C22,5.2 21.5,5 20.75,5 L3.25,5 C2.5,5 2,5.2 2,5.5 L2,8.5 C2,8.8 2.5,9 3.25,9 L20.75,9 C21.5,9 22,8.8 22,8.5 L22,5.5 Z M21,8 L3,8 L3,6 L21,6 L21,8 Z" fill-rule="nonzero"></path>\r\n    <path class="gjs-block-svg-path" d="M22,10.5 C22,10.2 21.5,10 20.75,10 L3.25,10 C2.5,10 2,10.2 2,10.5 L2,13.5 C2,13.8 2.5,14 3.25,14 L20.75,14 C21.5,14 22,13.8 22,13.5 L22,10.5 Z M21,13 L3,13 L3,11 L21,11 L21,13 Z" fill-rule="nonzero"></path>\r\n    <rect class="gjs-block-svg-path" x="2" y="15" width="10" height="3" rx="0.5"></rect>\r\n</svg>\r\n', "\n      <div>").concat(t.labels.form, "</div>"),
                        category: "Forms",
                        content: '\n         <div class="form-group">\n            <label class="col-form-label"><h6>Name</h6></label>\n            <input name="name" placeholder="Type here your name" class="form-control"/>\n          </div>\n          <div class="form-group">\n            <label><h6>Email</h6></label>\n            <input name="email" type="email" placeholder="Type here your email" class="form-control"/>\n          </div>\n          <div class="form-check">\n            <input name="sex" type="checkbox" class="form-check-input" value="M">\n            <label class="form-check-label">M</label>\n          </div>\n          <div class="form-check">\n            <input name="sex" type="checkbox" class="form-check-input" value="F">\n            <label class="form-check-label">F</label>\n          </div>\n          <div class="form-group">\n            <label><h6>Message<h6></label>\n            <textarea name="message" class="form-control"></textarea>\n          </div>\n   \n      '
                    }), a.input && (n.add("input", {
                        label: "\n      ".concat('<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,9 C22,8.4 21.5,8 20.75,8 L3.25,8 C2.5,8 2,8.4 2,9 L2,15 C2,15.6 2.5,16 3.25,16 L20.75,16 C21.5,16 22,15.6 22,15 L22,9 Z M21,15 L3,15 L3,9 L21,9 L21,15 Z"></path>\r\n    <polygon class="gjs-block-svg-path" points="4 10 5 10 5 14 4 14"></polygon>\r\n</svg>\r\n', "\n      <div>").concat(t.labels.input, "</div>"),
                        category: "Forms",
                        content: '  <div class="form-group">\n        <label><h6>Name</h6></label>\n        <input name="name" placeholder="Type here your name" class="form-control"/>\n      </div>\n '
                    }), n.add("file-input", {
                        label: "\n            ".concat('<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,9 C22,8.4 21.5,8 20.75,8 L3.25,8 C2.5,8 2,8.4 2,9 L2,15 C2,15.6 2.5,16 3.25,16 L20.75,16 C21.5,16 22,15.6 22,15 L22,9 Z M21,15 L3,15 L3,9 L21,9 L21,15 Z"></path>\r\n    <polygon class="gjs-block-svg-path" points="4 10 5 10 5 14 4 14"></polygon>\r\n</svg>\r\n', "\n            <div>").concat(t.labels.file_input, "</div>\n        "),
                        category: "Forms",
                        content: '<div class="form-group">\n<label><h6>File Browser</h6></label><div></div><div class="custom-file"><input type="file" class="custom-file-input"><label class="custom-file-label" for="customFile">Choose file</label></div></div>'
                    })), a.form_group_input && n.add("form_group_input", {
                        label: "\n      ".concat('<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,9 C22,8.4 21.5,8 20.75,8 L3.25,8 C2.5,8 2,8.4 2,9 L2,15 C2,15.6 2.5,16 3.25,16 L20.75,16 C21.5,16 22,15.6 22,15 L22,9 Z M21,15 L3,15 L3,9 L21,9 L21,15 Z"></path>\r\n    <polygon class="gjs-block-svg-path" points="4 10 5 10 5 14 4 14"></polygon>\r\n</svg>\r\n', "\n      <div>").concat(t.labels.form_group_input, "</div>"),
                        category: "Forms",
                        content: '\n      <div class="form-group">\n        <label><h6>Name<h/6></label>\n        <input name="name" placeholder="Type here your name" class="form-control"/>\n      </div>\n      '
                    }), a.input_group && n.add("input_group", {
                        label: "\n      ".concat('<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,9 C22,8.4 21.5,8 20.75,8 L3.25,8 C2.5,8 2,8.4 2,9 L2,15 C2,15.6 2.5,16 3.25,16 L20.75,16 C21.5,16 22,15.6 22,15 L22,9 Z M21,15 L3,15 L3,9 L21,9 L21,15 Z"></path>\r\n    <polygon class="gjs-block-svg-path" points="4 10 5 10 5 14 4 14"></polygon>\r\n</svg>\r\n', "\n      <div>").concat(t.labels.input_group, "</div>"),
                        category: "Forms",
                        content: '\n      <div class="input-group">\n        <div class="input-group-prepend">\n          <span class="input-group-text">$</span>\n        </div>\n        <input name="input1" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">\n        <div class="input-group-append">\n          <span class="input-group-text">.00</span>\n        </div>\n      </div>\n      '
                    }), a.textarea && n.add("textarea", {
                        label: "\n      ".concat('<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,7.5 C22,6.6 21.5,6 20.75,6 L3.25,6 C2.5,6 2,6.6 2,7.5 L2,16.5 C2,17.4 2.5,18 3.25,18 L20.75,18 C21.5,18 22,17.4 22,16.5 L22,7.5 Z M21,17 L3,17 L3,7 L21,7 L21,17 Z"></path>\r\n    <polygon class="gjs-block-svg-path" points="4 8 5 8 5 12 4 12"></polygon>\r\n    <polygon class="gjs-block-svg-path" points="19 7 20 7 20 17 19 17"></polygon>\r\n    <polygon class="gjs-block-svg-path" points="20 8 21 8 21 9 20 9"></polygon>\r\n    <polygon class="gjs-block-svg-path" points="20 15 21 15 21 16 20 16"></polygon>\r\n</svg>\r\n', "\n      <div>").concat(t.labels.textarea, "</div>"),
                        category: "Forms",
                        content: '<textarea name="textarea1" class="form-control"></textarea>'
                    }), a.select && n.add("select", {
                        label: "\n      ".concat('<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,9 C22,8.4 21.5,8 20.75,8 L3.25,8 C2.5,8 2,8.4 2,9 L2,15 C2,15.6 2.5,16 3.25,16 L20.75,16 C21.5,16 22,15.6 22,15 L22,9 Z M21,15 L3,15 L3,9 L21,9 L21,15 Z" fill-rule="nonzero"></path>\r\n    <polygon class="gjs-block-svg-path" transform="translate(18.500000, 12.000000) scale(1, -1) translate(-18.500000, -12.000000) " points="18.5 11 20 13 17 13"></polygon>\r\n    <rect class="gjs-block-svg-path" x="4" y="11.5" width="11" height="1"></rect>\r\n</svg>\r\n', "\n      <div>").concat(t.labels.select, "</div>"),
                        category: "Forms",
                        content: '<div class="form-group row"><label class="col-form-label col-lg-3 col-sm-12"><h6>Minimum Setup</h6></label><div class="col-lg-4 col-md-9 col-sm-12"><select class="form-control kt-selectpicker"><option>Mustard</option><option>Ketchup</option><option>Relish</option> </select></div></div>'
                    }), a.button && n.add("button", {
                        label: "\n      ".concat(J, "\n      <div>").concat(t.labels.button, "</div>"),
                        category: "Forms",
                        content: '<button class="btn btn-primary">Send</button>'
                    }), a.button_group && n.add("button_group", {
                        label: "\n            ".concat(J, "\n            <div>").concat(t.labels.button_group, "</div>\n        "),
                        category: "Forms",
                        content: {
                            type: "button_group"
                        }
                    }), a.button_toolbar && n.add("button_toolbar", {
                        label: "\n            ".concat(J, "\n            <div>").concat(t.labels.button_toolbar, "</div>\n        "),
                        category: "Forms",
                        content: {
                            type: "button_toolbar"
                        }
                    }), a.label && n.add("label", {
                        label: "\n      ".concat('<svg class="gjs-block-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">\r\n    <path class="gjs-block-svg-path" d="M22,11.875 C22,11.35 21.5,11 20.75,11 L3.25,11 C2.5,11 2,11.35 2,11.875 L2,17.125 C2,17.65 2.5,18 3.25,18 L20.75,18 C21.5,18 22,17.65 22,17.125 L22,11.875 Z M21,17 L3,17 L3,12 L21,12 L21,17 Z" fill-rule="nonzero"></path>\r\n     <polygon class="gjs-block-svg-path" fill-rule="nonzero" points="4 13 5 13 5 16 4 16"></polygon>\r\n</svg>\r\n', "\n      <div>").concat(t.labels.label, "</div>"),
                        category: "Forms",
                        content: "<label ><h6>Label</h6></label>"
                    }), a.checkbox && n.add("checkbox", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="fas" data-icon="check-square" class="svg-inline--fa fa-check-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zm-204.686-98.059l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.248-16.379-6.249-22.628 0L184 302.745l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.25 16.379 6.25 22.628.001z"></path></svg>\r\n', "\n            <div>").concat(t.labels.checkbox, "</div>\n        "),
                        category: "Forms",
                        content: '\n       <div class="form-group"><label> <h6>Checkbox Label</h6></label> <div class="kt-checkbox-inline"> <label class="kt-checkbox"><input type="checkbox" name="option" value="option1"> Option 1 <span></span>  </label><label class="kt-checkbox"><input type="checkbox" name="option" value="option2"> Option 2 <span></span> </label>  <label class="kt-checkbox"> <input type="checkbox" name="option" value="option3"> Option 3 <span></span> </label> </div> <span class="form-text text-muted">Some help text goes here</span> </div>\n      '
                    }), a.radio && n.add("radio", {
                        label: "\n            ".concat('<svg aria-hidden="true" width="24" height="50" focusable="false" data-prefix="far" data-icon="dot-circle" class="svg-inline--fa fa-dot-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 56c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m0-48C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 168c-44.183 0-80 35.817-80 80s35.817 80 80 80 80-35.817 80-80-35.817-80-80-80z"></path></svg>\r\n', "\n            <div>").concat(t.labels.radio, "</div>\n        "),
                        category: "Forms",
                        content: '\n        <div class="form-group">  <label><h6>Inline Radios</h6></label>  <div class="kt-radio-inline">  <label class="kt-radio"> <input type="radio" name="radio2"> Option 1 <span></span> </label> <label class="kt-radio"> <input type="radio" name="radio2"> Option 2 <span></span> </label> <label class="kt-radio"> <input type="radio" name="radio2"> Option 3 <span></span> </label>  </div> <span class="form-text text-muted">Some help text goes here</span> </div>\n '
                    }),a.star && n.add("star", {
                        label: "\n            ".concat('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/> <path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" fill="#fff"/></g></svg>\r\n', "\n            <div>").concat(t.labels.star, "</div>\n        "),
                        category: "Forms",
                        content: '\n  <div class="form-group"> <label> <h6>Star rating</h6></label><div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label></div></div>\n '
                    }),a.emoji && n.add("emoji", {
                        label: "\n            ".concat('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><rect fill="#000000" opacity="0.3" x="2" y="2" width="20" height="20" rx="10"/><path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" fill="#fff"/></g></svg>\r\n', "\n            <div>").concat(t.labels.emoji, "</div>\n        "),
                        category: "Forms",
                        content: '\n <div class="form-group"> <label> <h6>Emoji rating</h6></label><div class="form-group"> <input type="radio" class="rating__emoji" name="emoji" value="5"><label for="5">😍</label> <input type="radio" class="rating__emoji" name="emoji" value="4"><label for="4">😉</label> <input type="radio" name="emoji" class="rating__emoji" value="3"><label for="3">😊</label> <input type="radio" class="rating__emoji" name="emoji" value="2"><label for="2">☹️</label> <input type="radio" class="rating__emoji" name="emoji" value="1"><label for="1">😖</label></div></div>\n '
                    }),
                    a.switch && n.add("switch", {
                        label: "\n            ".concat('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <mask fill="white"> <use xlink:href="#path-1"/> </mask> <g/><path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#fff"/> </g></svg>\r\n', "\n            <div>").concat(t.labels.switch, "</div>\n        "),
                        category: "Forms",
                        content: '\n            <div class="form-group">  <label class="col-form-label"><h6>Primary</h6></label> <div class="col-3"><span class="kt-switch kt-switch--primary"><label><input type="checkbox" checked="checked" name="switch"><span></span></label> </span></div></div>  \n '
                    })
                }(e, o),
                function(e) {
                    var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                        n = e.DeviceManager;
                    if (t.gridDevices && (n.add("Extra Small", "575px"), n.add("Small", "767px"), n.add("Medium", "991px"), n.add("Large", "1199px"), n.add("Extra Large"), t.gridDevicesPanel)) {
                        var a = e.Panels,
                            r = e.Commands;
                        a.addPanel({
                            id: "devices-buttons"
                        }).get("buttons").add([{
                            id: "deviceXl",
                            command: "set-device-xl",
                            className: "fa fa-desktop",
                            text: "XL",
                            attributes: {
                                title: "Extra Large"
                            },
                            active: 1
                        }, {
                            id: "deviceLg",
                            command: "set-device-lg",
                            className: "fa fa-desktop",
                            attributes: {
                                title: "Large"
                            }
                        }, {
                            id: "deviceMd",
                            command: "set-device-md",
                            className: "fa fa-tablet",
                            attributes: {
                                title: "Medium"
                            }
                        }, {
                            id: "deviceSm",
                            command: "set-device-sm",
                            className: "fa fa-mobile",
                            attributes: {
                                title: "Small"
                            }
                        }, {
                            id: "deviceXs",
                            command: "set-device-xs",
                            className: "fa fa-mobile",
                            attributes: {
                                title: "Extra Small"
                            }
                        }]), r.add("set-device-xs", {
                            run: function(e) {
                                e.setDevice("Extra Small")
                            }
                        }), r.add("set-device-sm", {
                            run: function(e) {
                                e.setDevice("Small")
                            }
                        }), r.add("set-device-md", {
                            run: function(e) {
                                e.setDevice("Medium")
                            }
                        }), r.add("set-device-lg", {
                            run: function(e) {
                                e.setDevice("Large")
                            }
                        }), r.add("set-device-xl", {
                            run: function(e) {
                                e.setDevice("Extra Large")
                            }
                        })
                    }
                }(e, o),
                function(e) {
                    e.Config.canvasCss += '\n    /* Layout */\n\n    .gjs-dashed .container, .gjs-dashed .container-fluid,\n    .gjs-dashed .row,\n    .gjs-dashed .col, .gjs-dashed [class^="col-"] {\n      min-height: 1.5rem !important;\n    }\n    .gjs-dashed .w-100 {\n      min-height: .25rem !important;\n      background-color: rgba(0,0,0,0.1);\n    }\n    .gjs-dashed img {\n      min-width: 25px;\n      min-height: 25px;\n      background-color: rgba(0,0,0,0.5);\n    }\n\n    /* Components */\n\n    .gjs-dashed .btn-group,\n    .gjs-dashed .btn-toolbar {\n      padding-right: 1.5rem !important;\n      min-height: 1.5rem !important;\n    }\n    .gjs-dashed .card,\n    .gjs-dashed .card-group, .gjs-dashed .card-deck, .gjs-dashed .card-columns {\n      min-height: 1.5rem !important;\n    }\n    .gjs-dashed .collapse {\n      display: block !important;\n      min-height: 1.5rem !important;\n    }\n    .gjs-dashed .dropdown {\n      display: block !important;\n      min-height: 1.5rem !important;\n    }\n    .gjs-dashed .dropdown-menu {\n      min-height: 1.5rem !important;\n      display: block !important;\n    }\n  '
                }(e)
        })
    }], r.c = o, r.d = function(e, t, n) {
        r.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: n
        })
    }, r.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, r.t = function(t, e) {
        if (1 & e && (t = r(t)), 8 & e) return t;
        if (4 & e && "object" == typeof t && t && t.__esModule) return t;
        var n = Object.create(null);
        if (r.r(n), Object.defineProperty(n, "default", {
                enumerable: !0,
                value: t
            }), 2 & e && "string" != typeof t)
            for (var a in t) r.d(n, a, function(e) {
                return t[e]
            }.bind(null, a));
        return n
    }, r.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return r.d(t, "a", t), t
    }, r.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, r.p = "", r(r.s = 76);

    function r(e) {
        if (o[e]) return o[e].exports;
        var t = o[e] = {
            i: e,
            l: !1,
            exports: {}
        };
        return a[e].call(t.exports, t, t.exports, r), t.l = !0, t.exports
    }
    var a, o
});