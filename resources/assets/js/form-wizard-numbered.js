"use strict";
$((function() {
    const e = $(".select2")
      , t = $(".selectpicker");
    t.length && t.selectpicker(),
    e.length && e.each((function() {
        var e = $(this);
        e.wrap('<div class="position-relative"></div>'),
          e.select2({
            placeholder: "Select value",
            dropdownParent: e.parent()
          })
      }
    ))
  }
)),
  function() {
    const e = document.querySelector(".wizard-numbered")
      , t = [].slice.call(e.querySelectorAll(".btn-next"))
      , l = [].slice.call(e.querySelectorAll(".btn-prev"))
      , c = e.querySelector(".btn-submit");
    if (void 0 !== typeof e && null !== e) {
      const r = new Stepper(e,{
        linear: !1
      });
      t && t.forEach((e=>{
          e.addEventListener("click", (e=>{
              r.next()
            }
          ))
        }
      )),
      l && l.forEach((e=>{
          e.addEventListener("click", (e=>{
              r.previous()
            }
          ))
        }
      )),
      c && c.addEventListener("click", (e=>{
          alert("Submitted..!!")
        }
      ))
    }
    const r = document.querySelector(".wizard-vertical")
      , n = [].slice.call(r.querySelectorAll(".btn-next"))
      , i = [].slice.call(r.querySelectorAll(".btn-prev"))
      , o = r.querySelector(".btn-submit");
    if (void 0 !== typeof r && null !== r) {
      const e = new Stepper(r,{
        linear: !1
      });
      n && n.forEach((t=>{
          t.addEventListener("click", (t=>{
              e.next()
            }
          ))
        }
      )),
      i && i.forEach((t=>{
          t.addEventListener("click", (t=>{
              e.previous()
            }
          ))
        }
      )),
      o && o.addEventListener("click", (e=>{
          alert("Submitted..!!")
        }
      ))
    }
    const a = document.querySelector(".wizard-modern-example")
      , d = [].slice.call(a.querySelectorAll(".btn-next"))
      , s = [].slice.call(a.querySelectorAll(".btn-prev"))
      , u = a.querySelector(".btn-submit");
    if (void 0 !== typeof a && null !== a) {
      const e = new Stepper(a,{
        linear: !1
      });
      d && d.forEach((t=>{
          t.addEventListener("click", (t=>{
              e.next()
            }
          ))
        }
      )),
      s && s.forEach((t=>{
          t.addEventListener("click", (t=>{
              e.previous()
            }
          ))
        }
      )),
      u && u.addEventListener("click", (e=>{
          alert("Submitted..!!")
        }
      ))
    }
    const v = document.querySelector(".wizard-modern-vertical")
      , p = [].slice.call(v.querySelectorAll(".btn-next"))
      , S = [].slice.call(v.querySelectorAll(".btn-prev"))
      , b = v.querySelector(".btn-submit");
    if (void 0 !== typeof v && null !== v) {
      const e = new Stepper(v,{
        linear: !1
      });
      p && p.forEach((t=>{
          t.addEventListener("click", (t=>{
              e.next()
            }
          ))
        }
      )),
      S && S.forEach((t=>{
          t.addEventListener("click", (t=>{
              e.previous()
            }
          ))
        }
      )),
      b && b.addEventListener("click", (e=>{
          alert("Submitted..!!")
        }
      ))
    }
  }();
