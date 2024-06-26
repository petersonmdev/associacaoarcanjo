"use strict";
!function() {
  const a = document.querySelector("#TagifyBasic")
    , e = (new Tagify(a),
    document.querySelector("#TagifyReadonly"))
    , t = (new Tagify(e),
    document.querySelector("#TagifyCustomInlineSuggestion"))
    , n = document.querySelector("#TagifyCustomListSuggestion")
    , i = ["A# .NET", "A# (Axiom)", "A-0 System", "A+", "A++", "ABAP", "ABC", "ABC ALGOL", "ABSET", "ABSYS", "ACC", "Accent", "Ace DASL", "ACL2", "Avicsoft", "ACT-III", "Action!", "ActionScript", "Ada", "Adenine", "Agda", "Agilent VEE", "Agora", "AIMMS", "Alef", "ALF", "ALGOL 58", "ALGOL 60", "ALGOL 68", "ALGOL W", "Alice", "Alma-0", "AmbientTalk", "Amiga E", "AMOS", "AMPL", "Apex (Salesforce.com)", "APL", "AppleScript", "Arc", "ARexx", "Argus", "AspectJ", "Assembly language", "ATS", "Ateji PX", "AutoHotkey", "Autocoder", "AutoIt", "AutoLISP / Visual LISP", "Averest", "AWK", "Axum", "Active Server Pages", "ASP.NET"];
  new Tagify(t,{
    whitelist: i,
    maxTags: 1,
    dropdown: {
      maxItems: 1,
      classname: "tags-inline",
      enabled: 0,
      closeOnSelect: !1
    }
  }),
    new Tagify(n,{
      whitelist: i,
      maxTags: 1,
      dropdown: {
        maxItems: 1,
        classname: "",
        enabled: 0,
        closeOnSelect: !1
      }
    });
  const s = document.querySelector("#TagifyUserList");
  let l = new Tagify(s,{
    tagTextProp: "name",
    enforceWhitelist: !0,
    skipInvalid: !0,
    maxTags: 1,
    dropdown: {
      closeOnSelect: 1,
      enabled: 0,
      classname: "users-list",
      searchKeys: ["name", "email"]
    },
    templates: {
      tag: function(a) {
        return `\n    <tag title="${a.title || a.email}"\n      contenteditable='false'\n      spellcheck='false'\n      tabIndex="-1"\n      class="${this.settings.classNames.tag} ${a.class ? a.class : ""}"\n      ${this.getAttributes(a)}\n    >\n      <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>\n      <div>\n        <div class='tagify__tag__avatar-wrap'>\n          <img onerror="this.style.visibility='hidden'" src="${a.avatar}">\n        </div>\n        <span class='tagify__tag-text'>${a.name}</span>\n      </div>\n    </tag>\n  `
      },
      dropdownItem: function(a) {
        return `\n    <div ${this.getAttributes(a)}\n      class='tagify__dropdown__item align-items-center ${a.class ? a.class : ""}'\n      tabindex="0"\n      role="option"\n    >\n      ${a.avatar ? `<div class='tagify__dropdown__item__avatar-wrap'>\n          <img onerror="this.style.visibility='hidden'" src="${a.avatar}">\n        </div>` : ""}\n      <div class="fw-medium">${a.name}</div>\n      <span>${a.email}</span>\n    </div>\n  `
      },
      dropdownHeader: function(a) {
        return `\n        <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">\n            <strong>${this.value.length ? "Adicione o restante" : "Adicione o primeiro voluntário"}</strong>\n            <span>${a.length} members</span>\n        </div>\n    `
      }
    },
    whitelist: [{
      value: 1,
      name: "Justinian Hattersley",
      avatar: "https://i.pravatar.cc/80?img=1",
      email: "jhattersley0@ucsd.edu"
    }, {
      value: 2,
      name: "Antons Esson",
      avatar: "https://i.pravatar.cc/80?img=2",
      email: "aesson1@ning.com"
    }, {
      value: 3,
      name: "Ardeen Batisse",
      avatar: "https://i.pravatar.cc/80?img=3",
      email: "abatisse2@nih.gov"
    }, {
      value: 4,
      name: "Graeme Yellowley",
      avatar: "https://i.pravatar.cc/80?img=4",
      email: "gyellowley3@behance.net"
    }, {
      value: 5,
      name: "Dido Wilford",
      avatar: "https://i.pravatar.cc/80?img=5",
      email: "dwilford4@jugem.jp"
    }, {
      value: 6,
      name: "Celesta Orwin",
      avatar: "https://i.pravatar.cc/80?img=6",
      email: "corwin5@meetup.com"
    }, {
      value: 7,
      name: "Sally Main",
      avatar: "https://i.pravatar.cc/80?img=7",
      email: "smain6@techcrunch.com"
    }, {
      value: 8,
      name: "Grethel Haysman",
      avatar: "https://i.pravatar.cc/80?img=8",
      email: "ghaysman7@mashable.com"
    }, {
      value: 9,
      name: "Marvin Mandrake",
      avatar: "https://i.pravatar.cc/80?img=9",
      email: "mmandrake8@sourceforge.net"
    }, {
      value: 10,
      name: "Corrie Tidey",
      avatar: "https://i.pravatar.cc/80?img=10",
      email: "ctidey9@youtube.com"
    }]
  });
  l.on("dropdown:select", (function(a) {
      a.detail.elm.classList.contains(`${l.settings.classNames.dropdownItem}__addAll`) && l.dropdown.selectAll()
    }
  )).on("edit:start", (function({detail: {tag: a, data: e}}) {
      l.setTagTextNode(a, `${e.name} <${e.email}>`)
    }
  ));
  let r = Array.apply(null, Array(100)).map((function() {
      return Array.apply(null, Array(~~(10 * Math.random() + 3))).map((function() {
          return String.fromCharCode(26 * Math.random() + 97)
        }
      )).join("") + "@gmail.com"
    }
  ));
}();
