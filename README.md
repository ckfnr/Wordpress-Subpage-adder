# Automatic WordPress Subpage Adder

Dieses Snippet ermöglicht es, **bestehende Unterseiten automatisch in ein WordPress-Menü einzufügen**.  
Es ist besonders praktisch, wenn du viele Seiten hast und nicht jede Unterseite manuell in das Menü einfügen möchtest.  

---

## Voraussetzungen

- WordPress Version 5.4 oder höher  
- **Code Snippets Plugin** (oder eigenes Child-Theme, `functions.php`)  
  - Plugin-Link: [Code Snippets](https://de.wordpress.org/plugins/code-snippets/)  

---

## Funktionsweise

1. Das Snippet fügt im **Menü-Editor (`Design → Menüs`)** einen Button hinzu:  
   - **„Bestehende Unterseiten ins Menü einfügen“**  
   - Direkt darunter ein Eingabefeld, in dem du die **Oberpunkte (Parent-Seiten)** kommagetrennt eingibst, z. B.:  
     ```
     iPhone, Samsung, Tablet
     ```  

2. Klick auf den Button → alle Unterseiten der angegebenen Oberpunkte werden **einmalig** in das Menü eingefügt.  

3. Das Menü lädt sich automatisch neu, sodass du die hinzugefügten Unterseiten sofort sehen kannst.  

4. Nach dem einmaligen Import kann das Snippet **deaktiviert** werden, da die Unterseiten jetzt im Menü gespeichert sind.  

---

## Installation

1. Installiere und aktiviere das **Code Snippets Plugin**.  
2. Gehe zu **Snippets → Neu hinzufügen**.  
3. Füge den gesamten PHP-Code des Snippets ein.  
4. Speichere und aktiviere das Snippet.  
5. Gehe zu **Design → Menüs**.  
6. Im Menü-Editor erscheint nun das **Textfeld + Button** zum Einfügen der Unterseiten.  

---

## Hinweise

- Der Import läuft **nur einmalig** pro Klick.  
- Das Snippet unterstützt mehrere Oberpunkte gleichzeitig, einfach **kommagetrennt** eingeben.  
- Nach dem Import können die Unterseiten über **Max Mega Menu** oder andere Mega-Menu-Plugins sauber in Spalten angezeigt werden.  
- Die Oberpunkte müssen bereits im Menü existieren, damit das Snippet die Unterseiten einfügen kann.  

---

## Anpassung

- **Menüname**: Standardmäßig auf `'Hauptmenü'` gesetzt.  
  - Kann im Code angepasst werden, falls dein Menü anders heißt.  
- **Oberpunkte**: Werden aus dem Textfeld im Menü-Editor übernommen.  
- **Sicherheit**: Der Import wird über **Ajax + Nonce** abgesichert, sodass nur Administratoren ihn ausführen können.  

---

## Lizenz

Dieses Snippet ist Open Source und kann frei verwendet und angepasst werden.

