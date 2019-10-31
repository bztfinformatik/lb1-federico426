# LB1 - T2 // Funktional Anforderungen ohne DB

Dieses Projekt ist ein Beispiel für die Umsetzung der funktionalen Anforderungen - Einschränkungen:

- Kein DB-Backend
- Kein Session/Cookies
- Keine Authorisierung
- Kein Access-Control
- Models werden einfach für Fake-Daten missbraucht

## Zielsetzung

> Einfache Menü-Bestellungen in Mensa


## Entities / Models

Menue:
:   Menues, damit etwas bei der Bestellung zur Auswahl steht

Order:
:   Die Bestellung an sich

## Controllers

OrderController:
:   Controller damit Benutzer Bestellungen platzieren können

OrderAdminController:
:   Controller damit der Admin (Menübetreiber) die Bestellungen listen kann

## Views

OrderController:
:   Index/PlaceOrder (Hier käme noch das Listing der Bestellungen rein, wenn der Login mal gemacht ist)

OrderAdminController:
:   Index/ListOrders

